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
        this.posicaoAtual = this.posicaoInicial;
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
        this.limparLocalstorage()
        // --------------------------------------------------------
        root.appendChild(table)
    }

    jogadorPeca(peca){
        let jogadorPeca = peca.split('_')[1] 
        if(jogadorPeca == 'B'){
            return 'brancas' 
        }else if(jogadorPeca == 'P'){
            return 'pretas'
            } return '';
    }

    limparSelecao(){
        document.querySelectorAll('td').forEach( Element => {
            Element.classList.remove('selected')
        })
    }

    alternarVez(){
        if(this.jogadorVez == 'brancas'){
            this.jogadorVez = 'pretas' 
        }else if(this.jogadorVez == 'pretas'){
            this.jogadorVez = 'brancas'
        }
    }
    limparLocalstorage(){
        localStorage.setItem('posicaoClicada','')
        localStorage.setItem('coordenadaPecaClicada','')
        localStorage.setItem('coordenadaPecaSelecionada','')
        localStorage.setItem('pecaSelecionada','')
        localStorage.setItem('JogadorPeca','')
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
        let pecaClicada = entrada.firstElementChild.src.split('/')[6].replace('.png','')
        if(localStorage.getItem('pecaSelecionada') != ''){
            if(localStorage.getItem('JogadorPeca') == this.jogadorVez){
                // Executar lance
                this.limparSelecao()
                localStorage.setItem('pecaClicada',pecaClicada)
                localStorage.setItem('coordenadaPecaClicada', this.calcularPosicaoMatriz(id))
                this.consultarLance()
                this.limparSelecao()
                this.limparLocalstorage() 
                console.log('tentiva de lance')
            }
        else{
            // Não é a vez daquele jogador
            this.limparSelecao() 
            this.limparLocalstorage()
            console.log('Não é a vez daquele jogador')
            }
        }else{
            // Selecionar uma peça
            console.log('Selecionando peca')
            localStorage.setItem('coordenadaPecaSelecionada', this.calcularPosicaoMatriz(id))
            localStorage.setItem('pecaSelecionada', pecaClicada)
            localStorage.setItem('JogadorPeca', this.jogadorPeca(pecaClicada))
            entrada.classList.add('selected')
        }
    }
    consultarLance(){
        const body = {
            "coordenadaPecaSelecionada": localStorage.getItem('coordenadaPecaSelecionada'),
            "pecaSelecionada": localStorage.getItem('pecaSelecionada'),
            "JogadorPeca": localStorage.getItem('JogadorPeca'),
            "pecaClicada": localStorage.getItem('pecaClicada'),
            "jogadorVez": this.jogadorVez,
            "coordenadaPecaClicada": localStorage.getItem('coordenadaPecaClicada'),
            "posicaoAtual" :this.posicaoAtual
        }

        let requisicao = new XMLHttpRequest();
        requisicao.open('POST', 'http://localhost:8080')
        requisicao.onreadystatechange = ()=> {
            if (requisicao.readyState == 4){
                console.log(requisicao.responseText)
                let respose = JSON.parse(requisicao.responseText)
                if(respose.success){
                    this.efetuarLance(respose)
                }
            }
        }
        requisicao.send(JSON.stringify(body))
    }

    efetuarLance(response){
        const nomePeca = response.data.nomePeca
        const posicaoPecas = [response.data.jogada, response.data.posicaoPecaSelecionada]
        let ids =[]
        for(let controle =0; controle<2;controle++){
            const linha = posicaoPecas[controle][0]
            const coluna = posicaoPecas[controle][1]
            const idPosicao = (64-(linha*8))-coluna
            ids.push(idPosicao)
        }
        // Colocar peça na nova posição
        const imagemPecaNaPosicaoClicada = document.getElementById(ids[0]).firstElementChild
        imagemPecaNaPosicaoClicada.src="./assets/images/"+nomePeca+".png";
        // Limpar posição onde a peça estava
        const imagemPecaNaPosicao =  document.getElementById(ids[1]).firstElementChild
        imagemPecaNaPosicao.src="./assets/images/vazio.png";
        this.alternarVez();
    }
}
const tabuleiro = new Tabuleiro(root)
