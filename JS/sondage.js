/**
 * Created by 1253250 on 22/10/2015.
 */
function ShowAccount(Account){
    var DivListe = document.getElementById("ListeAccount")
    var Liste = document.createElement("select")
    var Option = document.createElement("option")
    Liste.setAttribute("size",5)
    Option.setAttribute("value",Account)
    Option.appendChild(document.createTextNode(Account))
    Liste.appendChild(Option)
    DivListe.appendChild(Liste)

}