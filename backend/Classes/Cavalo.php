<?php
    namespace Classes;
    use Classes\Peca as Peca;
     class Cavalo extends Peca{

        public function CalcularCasasPossiveis($lance){
            // criando um atributo 
            $this->possiveisCasas = [
                [$this->posicaoPecaSelecionada[0]-2,$this->posicaoPecaSelecionada[1]+1],
                [$this->posicaoPecaSelecionada[0]-2,$this->posicaoPecaSelecionada[1]-1],
                [$this->posicaoPecaSelecionada[0]-1,$this->posicaoPecaSelecionada[1]+2],
                [$this->posicaoPecaSelecionada[0]-1,$this->posicaoPecaSelecionada[1]-2],
                [$this->posicaoPecaSelecionada[0]+2,$this->posicaoPecaSelecionada[1]-1],
                [$this->posicaoPecaSelecionada[0]+2,$this->posicaoPecaSelecionada[1]+1],
                [$this->posicaoPecaSelecionada[0]+1,$this->posicaoPecaSelecionada[1]+2],
                [$this->posicaoPecaSelecionada[0]+1,$this->posicaoPecaSelecionada[1]-2]
            ];
            try{
            $this->jogadorPeca == 'brancas' ? $this->peca = 'B' : $this->peca = 'P';
            foreach($this->possiveisCasas as $indice => $value){
                if(
                    ($value[1]>= 0 && $value[1] <= 7) &&
                    ((isset($lance[$value[0]][$value[1]]) &&(
                    $lance[$value[0]][$value[1]] == 'vazio') || (
                    isset($lance[$value[0]][$value[1]]) &&
                    explode('_',$lance[$value[0]][$value[1]])[1] != $this->peca))
                    )
                )                   
                {
                    array_push($this->casasPossiveis,[$value[0],$value[1]]);
                }  
            }
        }catch(Exception $e){
            echo $e;
        }
        }
    }
?>