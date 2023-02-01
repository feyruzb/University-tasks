from sympy import randprime
from math import gcd

def egcd(a,b):
    if a == 0:
        return (b,0,1)
    else:
        g, x, y = egcd(b%a,a)
        return (g, y - (b//a) * x, x)

def modinv(b,n):
    g,x,_ = egcd(b,n)
    if g == 1:
        return x%n


prime_1 = 0
prime_2 = 0
key_size = 8

while prime_1 == prime_2 or (prime_1 * prime_2) > 2**key_size:
    prime_1 = randprime(3,2**key_size/2)
    prime_2 = randprime(3,2**key_size/2)



def generate_public_exponents(totient):
    public_exponent = 0
    for e in range(3,totient-1):
        if gcd(e, totient) == 1:
            public_exponent = e
            break
    return public_exponent


p1,p2 = prime_1, prime_2
totient = (p1-1)*(p2-1)
 
 
public_exponent = generate_public_exponents(totient)
private_exponent = modinv(public_exponent, totient)



def rsa_encrypt(plain_text, rsa_modulus, public_exponent):
    cipher = ''.join(chr((ord(ch)**public_exponent) % rsa_modulus) for ch in plain_text)
    return cipher.encode().hex()




def rsa_decrypt(cipher_text, rsa_modulus, private_exponent):
    print(cipher_text)
    print(rsa_modulus)
    print(private_exponent)
    return ''.join(chr((ord(ch)**private_exponent) % rsa_modulus) for ch in bytearray.fromhex(cipher_text).decode())
    
                   


text = "100AAA"
modulus = p1*p2
encrypt = rsa_encrypt(text,modulus, public_exponent)
decrypt = rsa_decrypt(encrypt, modulus, private_exponent)



print("Encrypted message = " + encrypt)
print("Decrypted message = " + decrypt)
# print(prime_1)
# print(prime_2)