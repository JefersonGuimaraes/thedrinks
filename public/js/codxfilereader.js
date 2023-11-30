class CODXFileReader{

    constructor(inputEl, imgEl){

        this.inputEl = inputEl
        this.imgEl = imgEl
        
        this.initInputEvent()
    }

    initInputEvent(){
        
        let input = document.querySelector(this.inputEl)
        let img = document.querySelector(this.imgEl)

        input.addEventListener("change", e=>{
            
            this.reader(e.target.files[0]).then(result => {
                
                img.src = result

            })

        })

    }

    reader(file){

        return new Promise((resolve, reject) => {

            let reader = new FileReader()

            reader.onload = function(){
                
                resolve(reader.result)

            }

            reader.onerror = function(){

                reject("Não foi possível ler a imagem")

            }

            reader.readAsDataURL(file)

        })
    }

}