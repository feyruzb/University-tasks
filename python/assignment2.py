from hashlib import sha1
from sympy import randprime
from math import gcd
from operator import xor
from pydoc import plain
import secrets
# from Crypto.Cipher import AES

# Functions

def generate_public_exponents(totient): # creates public key
    public_exponent = 0
    for e in range(3,totient-1):
        if gcd(e, totient) == 1:
            public_exponent = e
            break
    return public_exponent


def egcd(a,b): # e greatest common divisor 
    if a == 0:
        return (b,0,1)
    else:
        g, x, y = egcd(b%a,a)
        return (g, y - (b//a) * x, x)

def modinv(b,n): # Modular multiplicative inverse
    g,x,_ = egcd(b,n)
    if g == 1:
        return x%n

def rsa_decrypt(cipher_text, rsa_modulus, private_exponent): #DECRYPTION

    return ''.join(chr((ord(ch)**private_exponent) % rsa_modulus) for ch in bytearray.fromhex(cipher_text).decode()) 


def rsa_encrypt(plain_text, rsa_modulus, public_exponent): # ENCRYPTION
    cipher = ''.join(chr((ord(ch)**public_exponent) % rsa_modulus) for ch in plain_text)
    return cipher.encode().hex()


def generate_hash(name):
    return sha1(name.encode()).hexdigest()







# end funcitons

# prime1 = 179
# prime2 = 7
# modulus = 1253
# public exponent = 5
# Private exponent = 641
# Parameters #

key = secrets.token_bytes(16)

prime1 = 179 # fixed prime numbers
prime2 = 7  # fixed prime numbers

modulus = prime1*prime2 # modulus itself :D
totient = (prime1-1)*(prime2-1) # N number ()


public_exponent = generate_public_exponents(totient)
private_exponent = modinv(public_exponent, totient)

m = "Smaple code"

# Parameters end# 


# Main part #

En_m = generate_hash(m)
# print(En_m)

S = rsa_encrypt(En_m, 1253 , 641)

# print(S)

De_s = (rsa_decrypt(S, 1253, 5)) # dectyrpterd aes

 
# Task #
# iv = secrets.token_bytes(16)
# Enc = AES.new(key,AES.MODE_CBC, iv) 



BLOCK_SIZE = 16 # these ar ebites
pad = lambda s: s + (BLOCK_SIZE - len(s) %len(s) % BLOCK_SIZE) * chr(BLOCK_SIZE- len(s) %BLOCK_SIZE)
unpad = lambda s: s[:-ord(s[len(s) -1:])]

iv = secrets.token_bytes(16)
Enc = AES.new(key,AES.MODE_CBC, iv)
data  = pad (plaintext).encode()
ciphertext = Enc.encrypt(data)
ciphertext_hex = iv.hex() + ciphertext.hex()

iv =bytes.fromhex(ciphertext[:32])
ciphertext = bytes.fromhex(ciphertext[:32])
Dec = AES.new(key, AES.MODE_CBC, iv)
pt = Dec.decrypt(ciphertext)



if (De_s == En_m):
    print("Comparison good")
else:
    print("Not good")







































#  ░░░░░░░██████╗░███████╗██████╗░░░░░
# ░░██╗░░██ ╔══██╗██╔════╝██╔══██╗░░░░
# ██████╗██████╔╝█████╗░░██████╔╝░░░░
# ╚═██╔═╝██╔══██╗██╔══╝░░██╔═══╝░░░░░
# ░░╚═╝░░██║░░██║███████╗██║░░░░░░░░░
# ░░░░░░░╚═╝░░╚═╝╚══════╝╚═╝░░░░░░░░░

