import re
from taxpayer import Taxpayer

total_tax = 0

try:
    #Anigma arxeiou 
    with open('samostax.txt', 'r') as f:
        #Gia kathe grammi an iparxei keimeno pou na teriazei
        #me to pattern ton regex xorizei to keimeno kai to 
        #pernaei se kapoia values (AFM, kids ...) kai meta
        #pernaei afta ta values sto object tou class. Episis
        #me tin calculate_tax() ipologizei to tax tou kathe 
        #object kai sti sinexeia briskei to total kai to kanei
        #print
        for line in f:
            match = re.search(r"(\d+)\s+(\d+)\s+([\d.]+)\s+([\d.]+)", line)
        
            if match:
                AFM = match.group(1)
                kids = int(match.group(2))
                income = float(match.group(3))
                paidTax = float(match.group(4))        
                taxpayer = Taxpayer(AFM, kids, income, paidTax)
                tax = taxpayer.calculate_tax()
                total_tax += tax
            
    print(f'{total_tax:.2f}')
    
except FileNotFoundError:
    print('Error File not found :(')