<?php
    namespace Classes;
    use Classes\Peca as Peca;
     class Peao extends Peca{

        public function CalcularCasasPossiveis($lance){
            if ($this->jogadorPeca == 'brancas'){
                if($lance[$this->posicaoPecaSelecionada[0]-1][$this->posicaoPecaSelecionada[1]] == 'vazio'){
                    array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]-1,$this->posicaoPecaSelecionada[1]]);
                }
                if(
                $this->posicaoPecaSelecionada[0] == 6 &&
                $lance[$this->posicaoPecaSelecionada[0]-2][$this->posicaoPecaSelecionada[1]] == 'vazio' &&
                $lance[$this->posicaoPecaSelecionada[0]-1][$this->posicaoPecaSelecionada[1]] == 'vazio'){
                    array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]-2,$this->posicaoPecaSelecionada[1]]);
                }
                if(
                    ($this->posicaoPecaSelecionada[1]-1 >= 0 &&
                    isset(explode('_',$lance[$this->posicaoPecaSelecionada[0]-1][$this->posicaoPecaSelecionada[1]-1])[1])) && (
                    $lance[$this->posicaoPecaSelecionada[0]-1][$this->posicaoPecaSelecionada[1]-1] != 'vazio' ||
                    explode('_',$lance[$this->posicaoPecaSelecionada[0]-1][$this->posicaoPecaSelecionada[1]-1])[1] == "P"))
                    {
                        array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]-1,$this->posicaoPecaSelecionada[1]-1]);
                    }               
                if(
                    $this->posicaoPecaSelecionada[1]+1 <= 7 &&
                    isset(explode('_',$lance[$this->posicaoPecaSelecionada[0]-1][$this->posicaoPecaSelecionada[1]+1])[1]) && (
                    $lance[$this->posicaoPecaSelecionada[0]-1][$this->posicaoPecaSelecionada[1]+1] != 'vazio' ||
                    explode('_',$lance[$this->posicaoPecaSelecionada[0]-1][$this->posicaoPecaSelecionada[1]+1])[1] == "P"))
                    {
                        array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]-1,$this->posicaoPecaSelecionada[1]+1]);
                    }
             }
            else{
                if($lance[$this->posicaoPecaSelecionada[0]+1][$this->posicaoPecaSelecionada[1]] == 'vazio'){
                    array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]+1,$this->posicaoPecaSelecionada[1]]);
                }
                if(
                $this->posicaoPecaSelecionada[0] == 1 &&
                $lance[$this->posicaoPecaSelecionada[0]+2][$this->posicaoPecaSelecionada[1]] == 'vazio' &&
                $lance[$this->posicaoPecaSelecionada[0]+1][$this->posicaoPecaSelecionada[1]] == 'vazio'){
                    array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]+2,$this->posicaoPecaSelecionada[1]]);
                }
                if(
                    ($this->posicaoPecaSelecionada[1]-1 >= 0 &&
                    isset(explode('_',$lance[$this->posicaoPecaSelecionada[0]+1][$this->posicaoPecaSelecionada[1]-1])[1])) && (
                    $lance[$this->posicaoPecaSelecionada[0]+1][$this->posicaoPecaSelecionada[1]-1] != 'vazio'||
                    explode('_',$lance[$this->posicaoPecaSelecionada[0]+1][$this->posicaoPecaSelecionada[1]-1])[1] == "B"))
                    {
                        array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]+1,$this->posicaoPecaSelecionada[1]-1]);
                    }
                if(
                    ($this->posicaoPecaSelecionada[1]+1 <=7 &&
                    isset(explode('_',$lance[$this->posicaoPecaSelecionada[0]+1][$this->posicaoPecaSelecionada[1]+1])[1])) && (
                    $lance[$this->posicaoPecaSelecionada[0]+1][$this->posicaoPecaSelecionada[1]+1] != 'vazio' ||
                    explode('_',$lance[$this->posicaoPecaSelecionada[0]+1][$this->posicaoPecaSelecionada[1]+1])[1] == "B"))
                    {
                        array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]+1,$this->posicaoPecaSelecionada[1]+1]);
                    }
            }
        }
    }
?>