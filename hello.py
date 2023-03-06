from math import*

print("Hello, World!")
if 5 > 2:
  print("Five is greater than two!")
name="ViNo"
print(name.lower())  # similary upper
print(name.islower())  #true or false
print(len(name))
print(name[3])   #value of position
print(name.index("o"))  #position of value
print(name.replace("i","p"))  #position of value
num=30
print(str(num)+name)  #concating a string and number by converting number to string

txt = "My name is "+ name + "and I am {}{}"
print(txt.format(num,"years"))  #we can pass any number of arguments

print(sqrt(num))

# lname=input("enter your last name")   #input from user
# print(lname)


#####list####

names=["vino","bala","1","2","3.4"]
print(names[2:4])  #names print all the value

age=["24","28"]

names.extend(age) #age list added in names list 
# names.append("devi") added at last can use "names.insert(1,"devi")" to define the position
#names.remove("devi")
#names.clear() #remove all ,pop
#list accepts duplicate value
# names.count("vino") #return count value
#names.sort() 
# names.reverse()
#name1=names.copy()


print(names)


####tuples####

name_tuple=("a","b","c")

#cant change tuple values immutable

def print_name(name):
    print("111111vino",name)

print_name(name)

if age and name:  #not,and not, or, or not elif
   print("ages present")
else:
   print("no value")

####dictionaries####
 
#key value pair   
month={
   "jan":"1",
   2:"feb"
}
print(month["jan"])
print(month.get(2))




####Modules###
# import newproject ---- to import all function of that file

#from newproject import display_func as pf  ----to import specific function
#pf()


####class###

class Batsman:
   def __init__(self,name,team):
      self.name=name
      self.team=team
   def display(self):
      print(self.name,self.team)
   def show():
      print("inheritance")


player=Batsman("dhoni","csk")      

print(player.team)
player.display()

####inheritsnce###

class Players(Batsman):
    # pass
    def __init__(self, fname, lname):
      Batsman.__init__(self, fname, lname)


csk=Players("aa","bbb")
csk.display()


####set####

set1=set({"1","2"})
set2=set({})
set2.add("hi")
print(set2)  #duplicate not allowed