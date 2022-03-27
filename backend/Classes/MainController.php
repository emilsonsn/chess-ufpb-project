<?php
namespace Classes;
class MainController{
    public $lance;
    public $requestValidation;

    public function __construct(Array $post){
        $this->lance = $post;
        $this->requestValidation = $this->validarRequest();
        // $this->lance->posicaoAtual = json_encode($this->lance->posicaoAtual,);
        $this->requestValidation ? $this->verificarLance() : $this->lanceErro('Requisição incompleta');
    }

    public function validarRequest(){   
        $validation = true;
        if(sizeof($this->lance) == 7){
            foreach($this->lance as $indice => $value){
                if(!isset($value) || $value=''){
                    $validation =false;
                    break;
                }
            }
        }
        else{
            $validation =  false;
        }
        return $validation;
    }
    
    public function lanceErro(String $err){
        echo '{"success" : false,"data":"'.$err.'"}';
    }

    public function efetuarLance(Array $lance , String $nomePeca,Array $posicaoPecaSelecionada){
        print_r('{
            "success" : true,
            "data":{
                "jogada":'.json_encode($lance).',
                "nomePeca":"'.$nomePeca.'",
                "posicaoPecaSelecionada":'.json_encode($posicaoPecaSelecionada).'
                }
            }'
        );
    }

    public function verificarLance(){
        try{
            // verifica se é a vez daquele jogador
            if($this->lance['JogadorPeca'] == $this->lance['jogadorVez']) {
                // gerar nome da classe dinamicamente e instanciar
                $peca = str_replace('_P','',str_replace('_B','',$this->lance['pecaSelecionada']));
                $peca = 'Classes\\'.$peca;
                $peca = new $peca($this->lance);
                $peca->validacaoLance ? $this->efetuarLance($peca->tentativaLance, $peca->nome,$peca->posicaoPecaSelecionada) : lanceErro('lance inválido');
            }
            else{
                $this->lanceErro('Não é a sua vez');
            }
        }
        catch(Exception $e){
            lanceErro('Erro não identificado. ' . $e );
        }
    }
}
