const { default: axios } = require("axios")
const { error } = require("jquery")

$(document).ready(function(){
    $("a.list-item-delete").on("click",function(e){
        e.preventDefault()
        let url=$(this).attr("href")

        if (url!=null) {
            let confirmation=confirm("Bu kullanıcıyı silmek istediğinizden emin misiniz?");
            if (confirmation) {
                axios.delete(url).then(result=>{
                console.log(result.data)
            }).catch(error=>{
                console.log(error);
            })
            }
        }
    })
})
