import MySQLdb
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


db = MySQLdb.connect("localhost", "root", "informatics", "tcga")

cursor = db.cursor()
cursor.execute("DROP TABLE IF EXISTS brcaProteins")
createTable = """
	CREATE TABLE IF NOT EXISTS brcaProteins(
	patientBarkode varchar(50) NOT NULL,
	proteins TEXT DEFAULT NULL,
	PRIMARY KEY(patientBarkode)
	)
	"""
cursor.execute(createTable)

os.chdir('../tcga/BRCA/html/')
for file in glob.glob('*.sif'):
	#print file
	patientBarkod = file.split('_')[0]
	#print patientBarkod
	txt = open(file)
	fileContent = txt.read()
	try:
		cursor.execute("""INSERT INTO brcaProteins (patientBarkode,proteins)  VALUES (%s,%s)""",(patientBarkod,fileContent))
		db.commit()
		#print("Comiited")
	except:
		db.rollback()


#see the value is written or not.
#cursor.execute("select * from brcaProteins where patientBarkode=(%s);",("TCGA-AN-A0FZ-01"))
#print(cursor.fetchall())



#cursor.execute("select patientBarkode from brcaProteins where patientBarkode LIKE %s;",("%"+"AN-A0FZ"+"%"))
#print(cursor.fetchall())


#CENPJ
cursor.execute("select patientBarkode from brcaProteins where proteins LIKE %s;",("%"+"TBC1D7"+"%"))
print(cursor.fetchall())


