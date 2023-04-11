        const input = document.querySelector('#senha')
        const input2 = document.querySelector('#confirmaSenha')


        const icon = document.querySelector('#icon--password')
        const icon2 = document.querySelector('#icon--password2')
        
      
       
        icon.addEventListener('click', verificar)
        icon2.addEventListener('click', verificar2)
    

        function verificar() {
            console.log(icon)
            for (let i = 0; i < icon.classList.length; i++) {
                
                if (icon.classList[i].toString() == "bi-eye-fill") {
                    
                    
                    
                    
                    
                    input.type = "text"
                    icon.classList.remove('bi-eye-fill')
                    icon.classList.add("bi-eye-slash")

                    exit()

                } else if (icon.classList[i].toString() === "bi-eye-slash") {
                    
                    input.type = "password"
                    icon.classList.remove("bi-eye-slash")
                    icon.classList.add('bi-eye-fill')
                    exit()
                }
            }

        }

        function verificar2() {
            
            for (let i = 0; i < icon2.classList.length; i++) {
                
                if (icon2.classList[i].toString() == "bi-eye-fill") {                   
                    
                    input2.type = "text"
                    icon2.classList.remove('bi-eye-fill')
                    icon2.classList.add("bi-eye-slash")

                    exit()

                } else if (icon2.classList[i].toString() === "bi-eye-slash") {
                    input2.type = "password"
                    icon2.classList.remove("bi-eye-slash")
                    icon2.classList.add('bi-eye-fill')
                    exit()
                }
            }

        }