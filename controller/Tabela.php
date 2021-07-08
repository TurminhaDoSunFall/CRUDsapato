<?php
class Form
{
  public function __construct()
  {
    Transaction::open();
  }
  public function controller()
  {
    $form = new Template("view/form.html");
    $form->set("id", "");
    $form->set("estilo", "");
    $form->set("cor", "");
    $form->set("tamanho", "");
    $retorno["msg"] = $form->saida();
    return $retorno;
  }

  public function salvar()
  {
    if (isset($_POST["estilo"]) && isset($_POST["cor"]) && isset($_POST["tamanho"])) {
      try {
        $conexao = Transaction::get();
        $estilo = $conexao->quote($_POST["paciente"]);
        $cor = $conexao->quote($_POST["diag"]);
        $tamanho = $conexao->quote($_POST["idade"]);
        $crud = new Crud();
        if (empty($_POST["id"])) {
          $retorno = $crud->insert(
            "sapato",
            "estilo,cor,tamanho",
            "{$estilo},{$cor},{$tamanho}"
          );
        } else {
          $id = $conexao->quote($_POST["id"]);
          $retorno = $crud->update(
            "sapato",
            "estilo={$estilo}, cor={$cor}, tamanho={$tamanho}",
            "id={$id}"
          );
        }
      } catch (Exception $e) {
        $retorno["msg"] = "Ocorreu um erro! " . $e->getMessage();
        $retorno["erro"] = TRUE;
      }
    } else {
      $retorno["msg"] = "Preencha todos os campos! ";
      $retorno["erro"] = TRUE;
    }
    return $retorno;
  }

  public function __destruct()
  {
    Transaction::close();
  }
}