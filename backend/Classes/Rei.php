<?php
    namespace Classes;
    use Classes\Peca as Peca;
     class Rei extends Peca{

        public function CalcularCasasPossiveis(Array $lance){
            $this->jogadorPeca == 'brancas' ? $this->peca = 'B' : $this->peca = 'P';
            $possiveisMovimentos = [
                [$this->posicaoPecaSelecionada[0]-1,$this->posicaoPecaSelecionada[1]], //pra cima
                [$this->posicaoPecaSelecionada[0]+1,$this->posicaoPecaSelecionada[1]], //pra baixo
                [$this->posicaoPecaSelecionada[0],$this->posicaoPecaSelecionada[1]+1], //pra direita
                [$this->posicaoPecaSelecionada[0],$this->posicaoPecaSelecionada[1]-1], //pra esquerda
                [$this->posicaoPecaSelecionada[0]-1,$this->posicaoPecaSelecionada[1]+1], //diagonal superior direita
                [$this->posicaoPecaSelecionada[0]+1,$this->posicaoPecaSelecionada[1]+1], //diagonal inferior direita
                [$this->posicaoPecaSelecionada[0]-1,$this->posicaoPecaSelecionada[1]-1], //diagonal superior esquerda
                [$this->posicaoPecaSelecionada[0]+1,$this->posicaoPecaSelecionada[1]-1] //diagonal inferior esquerda
            ];
            foreach($possiveisMovimentos  as $indice => $value){
                if(
                ($value[0] <=7 && $value[0] >= 0) &&
                ($value[1] <=7 && $value[1] >= 0)
                ){
                    if (
                        isset($lance[$value[0]][$value[1]]) && (
                        isset(explode('_',$lance[$value[0]][$value[1]])[1]) &&
                        explode('_',$lance[$value[0]][$value[1]])[1] != $this->peca
                        )){
                        array_push($this->casasPossiveis,$value);
                    }
                    else if(
                        isset($lance[$value[0]][$value[1]]) &&
                        $lance[$value[0]][$value[1]] == "vazio"
                    ){
                        array_push($this->casasPossiveis,$value);
                    }
                }
            }
        }
    }
?>