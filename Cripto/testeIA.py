# import random
# import string
# from mistralai import Mistral
#
# # Gerar uma chave aleatória com um padrão específico
# def gerar_chave():
#     parte1 = ''.join(random.choices(string.ascii_uppercase + string.digits, k=5))
#     parte2 = ''.join(random.choices(string.ascii_uppercase + string.digits, k=5))
#     parte3 = ''.join(random.choices(string.ascii_uppercase + string.digits, k=5))
#
#     numero_controle = (sum(ord(c) for c in parte1) * 3 + sum(ord(c) for c in parte2) * 2) % 1000
#     codigo_verificacao = f"{numero_controle:03d}"  # Garante que tenha 3 dígitos
#
#     return f"{parte1}-{parte2}-{parte3}-{codigo_verificacao}"
#
#
# # Validar a chave usando a equação matemática
# def validar_chave(chave):
#     try:
#         partes = chave.split("-")
#         if len(partes) != 4:
#             return False
#
#         parte1, parte2, parte3, codigo_verificacao = partes
#         numero_controle_calculado = (sum(ord(c) for c in parte1) * 3 + sum(ord(c) for c in parte2) * 2) % 1000
#
#         return codigo_verificacao == f"{numero_controle_calculado:03d}"
#     except:
#         return False
#
# MISTRAL_API_KEY = "LUeu6zjrclTv9UWm4RkyNqc3dxrBIsED"
# client = Mistral(api_key=MISTRAL_API_KEY)
# model = "mistral-large-latest"
#
# key_validate = False
#
# CHAR_SET = ''.join([chr(i) for i in range(33, 127)])
#
# def gerar_mapeamento(chave):
#     random.seed(chave)
#     char_list = list(CHAR_SET)
#     random.shuffle(char_list)
#     return ''.join(char_list)
#
# def criptografar(texto, chave):
#     mapeamento = gerar_mapeamento(chave)
#     return ''.join(mapeamento[CHAR_SET.index(char)] if char in CHAR_SET else char for char in texto)
#
# def descriptografar_com_chave_correta(texto_criptografado, chave):
#     mapeamento = gerar_mapeamento(chave)
#     reverse_map = {mapeamento[i]: CHAR_SET[i] for i in range(len(CHAR_SET))}
#     return ''.join(reverse_map.get(char, char) for char in texto_criptografado)
#
# def gerar_texto_mistral(tamanho, chave):
#     temas = ["futebol", "tecnologia", "clima", "viagens","Politica","Militares"]
#     random.seed(chave)
#     tema_escolhido = random.choice(temas)
#
#     prompt = f"Escreva um texto sobre {tema_escolhido} com {tamanho} caracteres."
#
#     chat_response = client.chat.complete(
#         model=model,
#         messages=[
#             {
#                 "role": "user",
#                 "content": prompt,
#             },
#         ]
#     )
#
#     return chat_response.choices[0].message.content[:tamanho]
#
# def descriptografar_com_chave_errada(texto_criptografado, chave_errada):
#     return gerar_texto_mistral(len(texto_criptografado), chave_errada)
#
# # Função para solicitar e validar chave do usuário
# def pedir_chave():
#     chave_usuario = input("Digite a chave para validação (formato XXXXX-XXXXX-XXXXX-XXX): ")
#     texto_original = 'Texto Para ser descriptografado'
#     texto_criptografado = criptografar(texto_original, chave_usuario)
#     print("Texto Criptografado:", texto_criptografado)
#
#     if validar_chave(chave_usuario):
#         print("A chave é válida!")
#         key_validate = True
#     else:
#         print("A chave é inválida!")
#         key_validate = False
#
#     if key_validate == True:
#         texto_descriptografado = descriptografar_com_chave_correta(texto_criptografado, chave_usuario)
#         print("Texto Descriptografado (com chave correta):", texto_descriptografado)
#     else:
#         texto_errado = descriptografar_com_chave_errada(texto_criptografado, chave_usuario)
#         print("Texto Descriptografado (com chave errada):", texto_errado)
#
#
# # Testando o código
# chave_gerada = gerar_chave()
# print("Chave Gerada:", chave_gerada)
# # print("Validação:", validar_chave(chave_gerada))  # Deve retornar True
#
# # Testando uma chave falsa
# chave_falsa = chave_gerada[:-3] + f"{random.randint(0, 999):03d}"
# print("Chave Falsa:", chave_falsa)
# # print("Validação:", validar_chave(chave_falsa))  # Deve retornar False
#
# pedir_chave()
#
#
#
#
#
#
#
import random
import string
from mistralai import Mistral

# Gerar uma chave aleatória com um padrão específico
def gerar_chave():
    parte1 = ''.join(random.choices(string.ascii_uppercase + string.digits, k=5))
    parte2 = ''.join(random.choices(string.ascii_uppercase + string.digits, k=5))
    parte3 = ''.join(random.choices(string.ascii_uppercase + string.digits, k=5))

    numero_controle = (sum(ord(c) for c in parte1) * 3 + sum(ord(c) for c in parte2) * 2) % 1000
    codigo_verificacao = f"{numero_controle:03d}"  # Garante que tenha 3 dígitos

    chave_gerada = f"{parte1}-{parte2}-{parte3}-{codigo_verificacao}"
    return chave_gerada


# Gerar uma chave errada com base em um código matemático
def gerar_chave_errada(chave_correta):
    partes = chave_correta.split("-")
    parte1, parte2, parte3, codigo_verificacao = partes

    # Alterando o número de controle de forma controlada
    numero_controle_errado = (sum(ord(c) for c in parte1) * 3 + sum(ord(c) for c in parte2) * 2 + random.randint(1, 10)) % 1000
    codigo_verificacao_errado = f"{numero_controle_errado:03d}"

    return f"{parte1}-{parte2}-{parte3}-{codigo_verificacao_errado}"


# Validar a chave usando a equação matemática
def validar_chave(chave_fornecida, chaves_validas):
    try:
        # Verificando se o valor da chave fornecida existe entre os valores do dicionário
        for chave, valor in chaves_validas.items():
            if chave_fornecida == valor:
                if chave == 'e':
                    return False
                elif chave == 'c':
                    return True
                else:
                    return f"Chave inválida! Não é possível descriptografar com chave errada."
    except Exception as e:
        return f"Erro: {e}"


MISTRAL_API_KEY = "LUeu6zjrclTv9UWm4RkyNqc3dxrBIsED"
client = Mistral(api_key=MISTRAL_API_KEY)
model = "mistral-large-latest"

key_validate = False

CHAR_SET = ''.join([chr(i) for i in range(33, 127)])

def gerar_mapeamento(chave):
    random.seed(chave)
    char_list = list(CHAR_SET)
    random.shuffle(char_list)
    return ''.join(char_list)

def criptografar(texto, chave):
    mapeamento = gerar_mapeamento(chave)
    return ''.join(mapeamento[CHAR_SET.index(char)] if char in CHAR_SET else char for char in texto)

def descriptografar_com_chave_correta(texto_criptografado, chave):
    mapeamento = gerar_mapeamento(chave)
    reverse_map = {mapeamento[i]: CHAR_SET[i] for i in range(len(CHAR_SET))}
    return ''.join(reverse_map.get(char, char) for char in texto_criptografado)

def gerar_texto_mistral(tamanho, chave):
    temas = ["futebol", "tecnologia", "clima", "viagens","Politica","Militares"]
    random.seed(chave)
    tema_escolhido = random.choice(temas)

    prompt = f"Escreva um texto sobre {tema_escolhido} com {tamanho} caracteres."

    chat_response = client.chat.complete(
        model=model,
        messages=[
            {
                "role": "user",
                "content": prompt,
            },
        ]
    )

    return chat_response.choices[0].message.content[:tamanho]

def descriptografar_com_chave_errada(texto_criptografado, chave_errada):
    return gerar_texto_mistral(len(texto_criptografado), chave_errada)

# Função para solicitar e validar chave do usuário
def pedir_chave(chaves_validas):
    chave_usuario = input("Digite a chave para validação (formato XXXXX-XXXXX-XXXXX-XXX): ")
    texto_original = 'Texto Para ser descriptografado'
    texto_criptografado = criptografar(texto_original, chave_usuario)

    if validar_chave(chave_usuario, chaves_validas) == True:
        texto_descriptografado = descriptografar_com_chave_correta(texto_criptografado, chave_usuario)
        print("Texto Descriptografado (com chave correta):", texto_descriptografado)
    elif validar_chave(chave_usuario, chaves_validas) == False:
        try:
            # Ao tentar descriptografar com chave errada, agora o código irá gerar um erro.
            texto_errado = descriptografar_com_chave_errada(texto_criptografado, chave_usuario)
            print("Texto Descriptografado (com chave errada):", texto_errado)
        except ValueError as e:
            print(f"Erro: {e}")
    else:
        return print(f"Chave inválida! Não é possível descriptografar com chave errada.")



# Testando o código
chave_gerada = gerar_chave()
print("Chave Gerada:", chave_gerada)

# Gerar chave errada com base na chave correta
chave_errada = gerar_chave_errada(chave_gerada)
print("Chave Errada:", chave_errada)

# Lista de chaves válidas (tanto a correta quanto a errada)
# chaves_validas = [chave_gerada, chave_errada]
chaves_validas = {
    'c': chave_gerada,
    'e': chave_errada
}

pedir_chave(chaves_validas)


