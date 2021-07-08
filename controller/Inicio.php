<?php
class Inicio
{
  public function controller()
  {
    $inicio = new Template("view/inicio.html");
    $inicio->set("nome", "ISis jão pedroa");
    $retorno["msg"] = $inicio->saida();
    return $retorno;
  }
}
