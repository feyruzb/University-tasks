def decrypt(plain,key):
    
    decipher = ""
# transverse the plain text
    for i in range(len(plain)):
        char = plain[i]
# Dencrypt uppercase characters in plain text
        if (char.isupper()):
            decipher += chr((ord(char) - key - 65) % 26 + 65)
# Dencrypt lowercase characters in plain text
        else:
            decipher += chr((ord(char) - key - 97) % 26 + 97)
    return decipher


file = open("words.txt","r")

list = []

for i in file:
    list.append(i.strip())

In = input("Enter the word: ")
Protol = True

key=0
while Protol != False and key != 26:
        key+=1
        answer = decrypt(In,key)
       
        if answer in list:
            Protol = False
            


if Protol == False:
    print("Word detected: "+ str(answer)+ ", The key is: "+ str(key) )
else: 
    print("We have got a problem chef ")
       
#that word was encrypted with key 7 -----> gbnaplyshza







