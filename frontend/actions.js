const root = document.querySelectorAll('#root')[0]
root.appendChild

class Tabuleiro {
    constructor(root) {
        this.tela = root,
        this.jogadorVez = 'brancas'
        this.numeroColunas = 8,
        this.numeroLinhas = 8
        this.posicaoInicial =
        [["torre_P","cavalo_P","bispo_P","rei_P","rainha_P","bispo_P","cavalo_P","torre_P"],
        ["peao_P","peao_P","peao_P","peao_P","peao_P","peao_P","peao_P","peao_P"],
        ["vazio","vazio","vazio","vazio","vazio","vazio","vazio","vazio"],
        ["vazio","vazio","vazio","vazio","vazio","vazio","vazio","vazio"],
        ["vazio","vazio","vazio","vazio","vazio","vazio","vazio","vazio"],
        ["vazio","vazio","vazio","vazio","vazio","vazio","vazio","vazio"],
        ["peao_B","peao_B","peao_B","peao_B","peao_B","peao_B","peao_B","peao_B"],
        ["torre_B","cavalo_B","bispo_B","rei_B","rainha_B","bispo_B","cavalo_B","torre_B"]]

        localStorage.clear()
        // Montar tabuleiro na tela
        this._montarTabuleiro(this.posicaoInicial)
    }

    _montarTabuleiro(posicao){
        const table = document.createElement('table')
        const link = document.createElement('a')
        let contadorPosicao = 64
        let cor = ['fBranco','fPreto']
        let controleCor = 0
        // Iterar sobre o número de linhas e crialas
        for(let i =0; i<this.numeroLinhas;i++){
            let linha = document.createElement('tr')
            table.appendChild(linha)
        // Iterar sobre o número de colunas e crialas alternando entre as cores
            for(let z =0; z<this.numeroColunas;z++){
                let coluna = document.createElement('td')
                let peca = document.createElement('img')
                coluna.classList.add(cor[controleCor])
                peca.src = "./assets/images/"+posicao[i][z] +'.png'
                coluna.appendChild(peca)
                coluna.setAttribute('onclick','tabuleiro.preparaLance(this,this.id)')
                coluna.id = contadorPosicao     
                linha.appendChild(coluna)
                coluna.firstElementChild
                // Alternar entre as cores
                controleCor == 0 ? controleCor = 1 : controleCor = 0
                contadorPosicao--
            }
            // Repetir a ultima cor da ultima coluna na linha anterior na primeira coluna da nova linha
            controleCor == 0 ? controleCor = 1 : controleCor = 0
        }
        // resetar localstorage------------------------------------
        localStorage.setItem('coordenadaPecaSelecionada', '')
        localStorage.setItem('JogadorPeca', '')
        localStorage.setItem('pecaSelecionada', '')
        // --------------------------------------------------------
        root.appendChild(table)
    }

    jogadorPeca(peca){
        let jogadorPeca = peca.split('_')[1] == 'B' ? 'brancas' : 'pretas'; 
        return jogadorPeca;
    }

    limparSelecao(){
        document.querySelectorAll('td').forEach( Element => {
            Element.classList.remove('selected')
        })
        
    }

    calcularPosicaoMatriz(localizacaoTabuleiro){
        let linha = Math.floor((64-localizacaoTabuleiro)/this.numeroLinhas)
        let coluna = (64-(linha*this.numeroColunas) - localizacaoTabuleiro)
        let posicaoMatriz = linha+'|'+coluna
        return posicaoMatriz;
    }

    preparaLance(entrada,id){
        // Limpar seleção
        this.limparSelecao()
        let pecaNaPosicaoClicada = entrada.firstElementChild.src.split('/')[6].replace('.png','')
        if(pecaNaPosicaoClicada == 'vazio'){
            let corPeca = pecaNaPosicaoClicada.split('_')[1] == 'B' ? 'brancas' : 'pretas';
            if(localStorage.getItem('JogadorPeca') == this.jogadorVez){
                console.log('requisicao')
                this.limparSelecao()
                // chamar serviço
            }
            else{
                localStorage.setItem('pecaSelecionada', '')
                this.limparSelecao()
            }
        }else{
            // salvarSelecionado
            localStorage.setItem('coordenadaPecaSelecionada', this.calcularPosicaoMatriz(id))
            localStorage.setItem('JogadorPeca', this.jogadorPeca(pecaNaPosicaoClicada))
            localStorage.setItem('pecaSelecionada', pecaNaPosicaoClicada)
            entrada.classList.add('selected')
        }
    }
}

const tabuleiro = new Tabuleiro(root)
