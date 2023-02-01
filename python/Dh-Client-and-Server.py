from sympy import randprime
from math import gcd
from cryptography.hazmat.primitives import hashes
from cryptography.hazmat.primitives.asymmetric import dh
from cryptography.hazmat.primitives.kdf.hkdf import HKDF

def egcd(a,b): # greatest common divisor 
    if a == 0:
        return (b,0,1)
    else:
        g, x, y = egcd(b%a,a)
        return (g, y - (b//a) * x, x)

def modinv(b,n): # Modular multiplicative inverse
    g,x,_ = egcd(b,n)
    if g == 1:
        return x%n

def key_gen(key_size): # genrates key
    prime_1 = 0
    prime_2 = 0
    key_size = 8
    while prime_1 == prime_2 or (prime_1 * prime_2) > 2**key_size:
        prime_1 = randprime(3,2**key_size/2)
        prime_2 = randprime(3,2**key_size/2)
    return prime_1, prime_2


def generate_public_exponents(totient): # creates public key
    public_exponent = 0
    for e in range(3,totient-1):
        if gcd(e, totient) == 1:
            public_exponent = e
            break
    return public_exponent

parameters = dh.generate_parameters(generator=2, key_size=512)

alice_keys = parameters.generate_private_key()
bob_keys = parameters.generate_private_key()

alice_shared_key = alice_keys.exchange(bob_keys.public_key())
bob_shared_key = bob_keys.exchange(alice_keys.public_key())

derived_key = HKDF(
    algorithm=hashes.SHA256(),
    length=32,
    salt=None,
    info=b'handshake data',
).derive(alice_shared_key)


prime_1 = 0
prime_2 = 0


key_size = 18

while prime_1 == prime_2 or ( prime_1 * prime_2) > 2**key_size:
    prime_1 = randprime(3, 2**key_size/2)
    prime_2 = randprime(3, 2**key_size/2)




prime1 = 179 # fixed prime numbers
prime2 = 7  # fixed prime numbers

modulus = prime1*prime2 # modulus itself :D
totient = (prime1-1)*(prime2-1) # N number ()

public_exponent = generate_public_exponents(totient)
private_exponent = modinv(public_exponent, totient)






def rsa_encrypt(plain_text, rsa_modulus, public_exponent): # ENCRYPTION
    cipher = ''.join(chr((ord(ch)**public_exponent) % rsa_modulus) for ch in plain_text)
    return cipher.encode().hex()

def rsa_decrypt(cipher_text, rsa_modulus, private_exponent): #DECRYPTION

    return ''.join(chr((ord(ch)**private_exponent) % rsa_modulus) for ch in bytearray.fromhex(cipher_text).decode()) 



Mytext = rsa_encrypt("Alter", 1253 , 5)
cipheredtext = rsa_encrypt(Mytext, 249, 3)

alterego = rsa_decrypt(cipheredtext, 249, 55)
print(rsa_decrypt(alterego, 1253, 641))



# prime1 = 179
# prime2 = 7
# modulus = 1253
# public exponent = 5
# Private exponent = 641
  
# prime1 = 83
# prime2 = 3
# modulus = 249 
# public exponent = 3 
# Private exponent = 55 




#  ░░░░░░░██████╗░███████╗██████╗░░░░░
# ░░██╗░░██ ╔══██╗██╔════╝██╔══██╗░░░░
# ██████╗██████╔╝█████╗░░██████╔╝░░░░
# ╚═██╔═╝██╔══██╗██╔══╝░░██╔═══╝░░░░░
# ░░╚═╝░░██║░░██║███████╗██║░░░░░░░░░
# ░░░░░░░╚═╝░░╚═╝╚══════╝╚═╝░░░░░░░░░