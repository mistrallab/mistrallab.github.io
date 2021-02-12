import pymysql
#import pymysql.cursor
import glob,os




"""
lines = [line.rstrip('\n') for line in open('../tcga/BRCA/html/TCGA-A2-A0CL-01_merge.sif')]
print lines
for i in lines:
	print i.split('\t')[0]



os.chdir('../tcga/BRCA/html/')
for file in glob.glob('*.sif'):
	print file
"""


print("Hello world")

#createTables
db = pymysql.connect("localhost", "root", "informatics", "tcga")

cursor = db.cursor()
cursor.execute("DROP TABLE IF EXISTS IndividualProteinStructures")
cursor.execute("DROP TABLE IF EXISTS ProteinInteractions")
cursor.execute("DROP TABLE IF EXISTS Patients")
createTable = """
        CREATE TABLE IF NOT EXISTS Patients(
	ID int NOT NULL AUTO_INCREMENT,
	BARCODE varchar(50),
	DISEASE_TYPE varchar(50),
	PAGE_URL varchar(255),
        KEY (BARCODE),
	PRIMARY KEY(ID)
	)
	"""
cursor.execute(createTable)
createTable2 = """
        CREATE TABLE IF NOT EXISTS ProteinInteractions(
	ID int NOT NULL AUTO_INCREMENT,
	PATIENT_ID varchar(50),
	SOURCE varchar(255),
	TARGET varchar(255),
	EDGE_STRUCTURE_TYPE varchar(255),
        INDEX patient_ind (PATIENT_ID),
	CONSTRAINT FOREIGN KEY(PATIENT_ID) 
        REFERENCES Patients(BARCODE) 
	ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY(ID)

	);
	"""
cursor.execute(createTable2)
createTable3 = """
	CREATE TABLE IF NOT EXISTS IndividualProteinStructures(
	ID int NOT NULL AUTO_INCREMENT,
	PATIENT_ID varchar(50),
	PROTEIN varchar(255),
	STRUCTURE_TYPE varchar(255) DEFAULT NULL,
	SCORE FLOAT(23,19) DEFAULT 0.0,
	INDEX patient_ind (PATIENT_ID),
	CONSTRAINT FOREIGN KEY(PATIENT_ID) 
	REFERENCES Patients(BARCODE) 
	ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY(ID)

	);
	"""
cursor.execute(createTable3)
#createTables






def readProteinInteractions(patientBarkod):
        lines = [line.rstrip('\n') for line in open(patientBarkod+'_merge.sif')]
        #print(lines)
        for i in lines:
                #print(i.split('\t')[0],i.split('\t')[1],i.split('\t')[2])
                try:
                        cursor.execute("""INSERT INTO ProteinInteractions (PATIENT_ID,SOURCE,TARGET,EDGE_STRUCTURE_TYPE)  VALUES (%s,%s,%s,%s)""",
                                       (patientBarkod,i.split('\t')[0],i.split('\t')[1],i.split('\t')[2]))
                        db.commit()
                        #print("Comiited")
                except:
                        db.rollback()


def readAndMergeProteinStructuresandTerminals(patientBarkod):
        lines = [line.rstrip('\n') for line in open(patientBarkod+'_nodeshape.txt')]
        unionList = []
        for i in lines:
                if i.split('\t')[0]  not in unionList:
                        unionList.append(i.split('\t')[0])

        #print(len(unionList))
        linesTerminal = [line.rstrip('\n') for line in open(patientBarkod+'.terminal')]
        for j in linesTerminal:
                if j.split('\t')[0]  not in unionList:
                        unionList.append(j.split('\t')[0])
                        print(j.split('\t')[0])

        #insert all proteins
        for protein in unionList:
                try:
                        cursor.execute("""INSERT INTO IndividualProteinStructures (PATIENT_ID,PROTEIN)  VALUES (%s,%s)""",(patientBarkod,protein))
                        db.commit()
                        #print("Comiited")
                except:
                        db.rollback()

        #insert Terminals
        terminals = [line.rstrip('\n') for line in open(patientBarkod+'.terminal')]
        for i in terminals:
                #print(float(i.split('\t')[1]),patientBarkod,i.split('\t')[0])
                try:
                        cursor.execute("""UPDATE IndividualProteinStructures set SCORE = %s WHERE PATIENT_ID = %s AND PROTEIN = %s""",
                                       (float(i.split('\t')[1]),patientBarkod,i.split('\t')[0]))
                        db.commit()
                except:
                        db.rollback()


        #insert individualStructures
        structures = [line.rstrip('\n') for line in open(patientBarkod+'_nodeshape.txt')]
        for i in structures:
                try:
                        cursor.execute("""UPDATE IndividualProteinStructures set STRUCTURE_TYPE = %s WHERE PATIENT_ID = %s AND PROTEIN = %s""",
                                       (i.split('\t')[1],patientBarkod,i.split('\t')[0]))
                        db.commit()
                except:
                        db.rollback()




os.chdir('../tcga/BRCA/html/')
for file in glob.glob('*.sif'):
	#print file
	patientBarkod = file.split('_')[0]
	print(patientBarkod)
	txt = open(file)
	fileContent = txt.read()
	try:
		cursor.execute("""INSERT INTO Patients (BARCODE,DISEASE_TYPE,PAGE_URL)  VALUES (%s,%s,%s)""",
                               (patientBarkod,"BRCA","../tcga/BRCA/html/"+patientBarkod+"_merge_main.html"))
		db.commit()
		#print("Comiited")
	except:
		db.rollback()
	readProteinInteractions(patientBarkod)
	readAndMergeProteinStructuresandTerminals(patientBarkod)
