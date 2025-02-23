import random
import string


# Gerar uma chave válida seguindo um padrão específico
def gerar_chave():
    parte1 = ''.join(random.choices(string.ascii_uppercase + string.digits, k=5))
    parte2 = ''.join(random.choices(string.ascii_uppercase + string.digits, k=5))
    parte3 = ''.join(random.choices(string.ascii_uppercase + string.digits, k=5))

    # Criando um número de controle baseado em uma equação matemática
    numero_controle = (sum(ord(c) for c in parte1) * 3 + sum(ord(c) for c in parte2) * 2) % 1000
    codigo_verificacao = f"{numero_controle:03d}"  # Garante que tenha 3 dígitos

    return f"{parte1}-{parte2}-{parte3}-{codigo_verificacao}"


# Validar a chave usando a equação matemática
def validar_chave(chave):
    try:
        partes = chave.split("-")
        if len(partes) != 4:
            return False

        parte1, parte2, parte3, codigo_verificacao = partes
        numero_controle_calculado = (sum(ord(c) for c in parte1) * 3 + sum(ord(c) for c in parte2) * 2) % 1000

        return codigo_verificacao == f"{numero_controle_calculado:03d}"
    except:
        return False


# Testando o código
chave_gerada = gerar_chave()
print("Chave Gerada:", chave_gerada)
print("Validação:", validar_chave(chave_gerada))  # Deve retornar True

# Testando uma chave falsa
chave_falsa = chave_gerada[:-3] + f"{random.randint(0, 999):03d}"
print("Chave Falsa:", chave_falsa)
print("Validação:", validar_chave(chave_falsa))  # Deve retornar False
