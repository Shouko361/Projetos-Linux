import random
import string
from dotenv import load_dotenv
import os

from mistralai import Mistral


def generate_key():
    parts = [''.join(random.choices(string.ascii_uppercase + string.digits, k=5)) for _ in range(3)]
    control_number = (sum(ord(c) for c in parts[0]) * 3 + sum(ord(c) for c in parts[1]) * 2) % 1000
    verification_code = f"{control_number:03d}"
    return f"{parts[0]}-{parts[1]}-{parts[2]}-{verification_code}"


def generate_invalid_key(correct_key):
    parts = correct_key.split("-")
    part1, part2, part3, verification_code = parts
    invalid_control_number = (sum(ord(c) for c in part1) * 3 + sum(ord(c) for c in part2) * 2 + random.randint(1,
                                                                                                               10)) % 1000
    invalid_verification_code = f"{invalid_control_number:03d}"
    return f"{part1}-{part2}-{part3}-{invalid_verification_code}"


def validate_key(provided_key, valid_keys):
    try:
        for key, value in valid_keys.items():
            if provided_key == value:
                return key == 'c'
        return "Chave inválida! Não é possível descriptografar com chave errada."
    except Exception as e:
        return f"Erro: {e}"


CHAR_SET = ''.join([chr(i) for i in range(33, 127)])


def generate_mapping(key):
    random.seed(key)
    char_list = list(CHAR_SET)
    random.shuffle(char_list)
    return ''.join(char_list)


def encrypt_file(file_path, key, encrypted_file_path):
    with open(file_path, 'rb') as f:
        file_content = f.read()

    mapping = generate_mapping(key)

    encrypted_content = bytearray()

    for byte in file_content:
        char = chr(byte)
        if char in CHAR_SET:
            encrypted_content.append(ord(mapping[CHAR_SET.index(char)]))
        else:
            encrypted_content.append(byte)

    with open(encrypted_file_path, 'wb') as f:
        f.write(encrypted_content)
        # os.remove(file_path)



def decrypt_file_with_correct_key(file_path, key, decrypted_file_path):
    with open(file_path, 'rb') as f:
        encrypted_content = f.read()

    mapping = generate_mapping(key)
    reverse_map = {mapping[i]: CHAR_SET[i] for i in range(len(CHAR_SET))}

    decrypted_content = bytearray()

    for byte in encrypted_content:
        char = chr(byte)
        if char in reverse_map:
            decrypted_content.append(ord(reverse_map[char]))
        else:
            decrypted_content.append(byte)

    with open(decrypted_file_path, 'wb') as f:
        f.write(decrypted_content)


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

def decrypt_file_with_invalid_key(file_path, invalid_key, decrypted_file_path):
    encrypted_content = open(file_path, 'rb').read()
    load_dotenv()

    file_size = len(encrypted_content)

    file_sample = encrypted_content[:min(file_size, 100)]  # Pega uma amostra do arquivo
    file_sample_str = ''.join(
        chr(byte) if 32 <= byte <= 126 else '?' for byte in file_sample)  # Converte para caracteres visíveis
    print(file_sample_str)
    prompt = f"Crie um texto fictício inspirado nas características do arquivo com base na amostra a seguir:\n\n{file_sample_str}\n\nA chave fornecida é errada, então gere um conteúdo relevante para esse arquivo com o tamanho de {file_size} caracteres."

    client = Mistral(api_key=os.environ['MISTRAL_API_KEY'])
    model = "mistral-large-latest"

    chat_response = client.chat.complete(model=model, messages=[{"role": "user", "content": prompt}])

    generated_text = chat_response.choices[0].message.content[:file_size]

    with open(decrypted_file_path, 'w') as f:
        f.write(generated_text)

    print(f"Arquivo descriptografado (com chave errada) gerado em: {decrypted_file_path}")


def request_and_validate_key(valid_keys):
    user_key = input("Digite a chave para validação (formato XXXXX-XXXXX-XXXXX-XXX): ")
    original_file_path = 'teste.js'
    encrypted_file_path = original_file_path + '.enc'
    decrypted_file_path = original_file_path

    encrypt_file(original_file_path, user_key, encrypted_file_path)

    validation_result = validate_key(user_key, valid_keys)
    if validation_result is True:
        decrypt_file_with_correct_key(encrypted_file_path, user_key, decrypted_file_path)
        print(f"Arquivo descriptografado (com chave correta): {decrypted_file_path}")
    elif validation_result is False:
        try:
            decrypt_file_with_invalid_key(encrypted_file_path, user_key, decrypted_file_path)
            print(f"Arquivo descriptografado (com chave errada): {decrypted_file_path}")
        except ValueError as e:
            print(f"Erro: {e}")
    else:
        print(validation_result)


generated_key = generate_key()
print("Chave Gerada:", generated_key)

invalid_key = generate_invalid_key(generated_key)
print("Chave Errada:", invalid_key)

valid_keys = {
    'c': generated_key,
    'e': invalid_key
}

request_and_validate_key(valid_keys)
