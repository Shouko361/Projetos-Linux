import random
import string
from dotenv import load_dotenv
import os
from mistralai import Mistral

# Função para gerar uma chave aleatória
def generate_key():
    parts = [''.join(random.choices(string.ascii_uppercase + string.digits, k=5)) for _ in range(3)]
    control_number = (sum(ord(c) for c in parts[0]) * 3 + sum(ord(c) for c in parts[1]) * 2) % 1000
    verification_code = f"{control_number:03d}"
    return f"{parts[0]}-{parts[1]}-{parts[2]}-{verification_code}"

# Função para gerar uma chave errada com base na chave correta
def generate_invalid_key(correct_key):
    parts = correct_key.split("-")
    part1, part2, part3, verification_code = parts
    invalid_control_number = (sum(ord(c) for c in part1) * 3 + sum(ord(c) for c in part2) * 2 + random.randint(1, 10)) % 1000
    invalid_verification_code = f"{invalid_control_number:03d}"
    return f"{part1}-{part2}-{part3}-{invalid_verification_code}"

# Função para validar a chave com base em um dicionário de chaves válidas
def validate_key(provided_key, valid_keys):
    try:
        for key, value in valid_keys.items():
            if provided_key == value:
                return key == 'c'
        return "Chave inválida! Não é possível descriptografar com chave errada."
    except Exception as e:
        return f"Erro: {e}"

# Mapeamento de caracteres para criptografar
CHAR_SET = ''.join([chr(i) for i in range(33, 127)])

def generate_mapping(key):
    random.seed(key)
    char_list = list(CHAR_SET)
    random.shuffle(char_list)
    return ''.join(char_list)

# Função para criptografar o texto
def encrypt(text, key):
    mapping = generate_mapping(key)
    return ''.join(mapping[CHAR_SET.index(char)] if char in CHAR_SET else char for char in text)

# Função para descriptografar com chave correta
def decrypt_with_correct_key(encrypted_text, key):
    mapping = generate_mapping(key)
    reverse_map = {mapping[i]: CHAR_SET[i] for i in range(len(CHAR_SET))}
    return ''.join(reverse_map.get(char, char) for char in encrypted_text)

# Função para gerar texto com Mistral
def generate_text_with_mistral(size, key):
    load_dotenv()
    themes = ["futebol", "tecnologia", "clima", "viagens", "politica", "militares"]
    random.seed(key)
    selected_theme = random.choice(themes)
    prompt = f"Escreva um texto sobre {selected_theme} com {size} caracteres."
    client = Mistral(api_key=os.environ['MISTRAL_API_KEY'])
    model = "mistral-large-latest"
    chat_response = client.chat.complete(model=model, messages=[{"role": "user", "content": prompt}])
    return chat_response.choices[0].message.content[:size]

# Função para descriptografar com chave errada
def decrypt_with_invalid_key(encrypted_text, invalid_key):
    return generate_text_with_mistral(len(encrypted_text), invalid_key)

# Função principal para pedir a chave do usuário e validar
def request_and_validate_key(valid_keys):
    user_key = input("Digite a chave para validação (formato XXXXX-XXXXX-XXXXX-XXX): ")
    original_text = 'Texto Para ser descriptografado'
    encrypted_text = encrypt(original_text, user_key)

    validation_result = validate_key(user_key, valid_keys)
    if validation_result is True:
        decrypted_text = decrypt_with_correct_key(encrypted_text, user_key)
        print("Texto Descriptografado (com chave correta):", decrypted_text)
    elif validation_result is False:
        try:
            decrypted_text_with_invalid_key = decrypt_with_invalid_key(encrypted_text, user_key)
            print("Texto Descriptografado (com chave errada):", decrypted_text_with_invalid_key)
        except ValueError as e:
            print(f"Erro: {e}")
    else:
        print(validation_result)

# Testando o código
generated_key = generate_key()
print("Chave Gerada:", generated_key)

invalid_key = generate_invalid_key(generated_key)
print("Chave Errada:", invalid_key)

valid_keys = {
    'c': generated_key,
    'e': invalid_key
}

request_and_validate_key(valid_keys)