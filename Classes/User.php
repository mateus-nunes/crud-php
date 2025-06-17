<?php

require_once __DIR__ . "/BD.php";

class User
{

    const uploadDir = "imagens/";
    const tiposPermitidos = ["image/jpeg", "image/png"];
    const maxSize = 5 * 1024 * 1024;//5MB

    /**
     * Busca todos os usuários cadastrados
     * @return array
     */
    public static function getAll()
    {
        $conn = BD::getConnection();

        $sql = $conn->query("SELECT * FROM users");

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getById($id)
    {
        $conn = BD::getConnection();

        $sql = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Função para inserir usuário no banco
     * @param mixed $nome
     * @param mixed $email
     * @param mixed $senha
     * @param mixed $foto
     * @return int
     */
    public function inserir($nome, $email, $senha, $foto = null)
    {
        $conn = BD::getConnection();
        //criptografa a senha
        $hash = self::hashSenha($senha);

        //Upload da foto
        if (is_array($foto) and is_uploaded_file($foto['tmp_name'])) {
            $foto = self::uploadPhoto($foto);
        }

        //Executa o sql de inserção
        $sql = $conn->prepare("INSERT INTO users(name, mail, password, image) VALUES (:name,:mail,:password,:image)");
        $sql->bindValue(":name", $nome);
        $sql->bindValue(":mail", $email);
        $sql->bindValue(":password", $hash);
        $sql->bindValue(":image", $foto);
        $sql->execute();

        //Retorna o ID do usuário criado
        return $conn->lastInsertId();
    }

    /**
     * Função para atualizar o usuário
     * @param mixed $id
     * @param mixed $nome
     * @param mixed $email
     * @param mixed $senha
     * @param mixed $foto
     * @throws \Exception
     * @return bool
     */
    public function atualizar($id, $nome, $email, $senha = null, $foto = null)
    {
        $conn = BD::getConnection();

        //Consulta ao BD
        $user = self::getById($id);

        if (!$user) {
            throw new Exception("Usuário não encontrado");
        }

        if ($senha) {
            //criptografa a senha
            $hash = self::hashSenha($senha);
        } else {
            $hash = $user->password;
        }

        //Upload da foto, caso seja atualizada
        if (is_array($foto) and is_uploaded_file($foto['tmp_name'])) {
            $filename = User::uploadPhoto($foto);

            $fileOriginal = User::uploadDir . $user->image;
            if (file_exists($fileOriginal)) {
                unlink($fileOriginal);
            }
        } else {
            $filename = $user->image;
        }

        //criptografa a senha
        $hash = self::hashSenha($senha);

        //Executa o sql de inserção
        $sql = $conn->prepare("UPDATE users SET name = :name, mail = :mail, password = :password, image = :image WHERE id = :id");
        $sql->bindValue(":name", $nome);
        $sql->bindValue(":mail", $email);
        $sql->bindValue(":password", $hash);
        $sql->bindValue(":image", $filename);
        $sql->bindValue(":id", $user->id);
        $sql->execute();

        return true;
    }

    /**
     * Exclui um usuário
     * @param mixed $id
     * @throws \Exception
     * @return bool
     */
    public static function delete($id)
    {
        $conn = BD::getConnection();

        //Consulta ao BD
        $user = self::getById($id);

        if (!$user) {
            throw new Exception("Usuário não encontrado");
        }

        $sql = $conn->prepare("DELETE FROM users WHERE id = :id");
        $sql->bindValue(":id", $user->id);
        $sql->execute();

        return true;
    }

    /**
     * Criptografa a senha informada
     * @param mixed $senha
     * @return string
     */
    public static function hashSenha($senha)
    {
        return password_hash($senha, PASSWORD_BCRYPT);
    }

    /**
     * Faz o upload da imagem de perfil do usuário
     * @param mixed $file
     * @throws \Exception
     * @return string
     */
    public static function uploadPhoto($file)
    {
        $type = $file["type"];
        $size = $file["size"];

        if (!in_array($type, self::tiposPermitidos)) {
            throw new Exception("Tipo de arquivo não permitido");
        }

        if ($size > self::maxSize) {
            throw new Exception("Arquivo maior que o permitido");
        }

        $ext = pathinfo(basename($file["name"]), PATHINFO_EXTENSION);
        $name = uniqid("user_") . "." . $ext;

        if (move_uploaded_file($file['tmp_name'], self::uploadDir . $name)) {
            return $name;
        } else {
            die("Erro no upload");
        }
    }

    /**
     * Retorna o caminho onde a foto está salva, caso não exista retorna uma imagem padrão
     * @param mixed $foto
     * @return string
     */
    public static function getPathPhoto($foto)
    {
        $path = __DIR__ . "/../" . self::uploadDir;
        if (is_file($path . $foto)) {
            return self::uploadDir . $foto;
        }

        return self::uploadDir . "user_default.jpg";
    }
}