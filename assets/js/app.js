import '../css/app.scss';
import { Dropdown } from "bootstrap";

document.addEventListener('DOMContentLoaded',() => { // JAVA* au moment ou le document est complétement chargé on apelle la fonction enableDropdowns activer les listes deroulantes();//
    new App();
});

class App {
    constructor() {
        this.enableDropdowns();  //activation menu deroulant//
        this.handleCommentForm();  
    }

    enableDropdowns() {
        const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        dropdownElementList.map(function (dropdownToggleEl) {
            return new Dropdown(dropdownToggleEl)
        });
}
handleCommentForm() {
    const commentForm = document.querySelector('form.comment-form');
    
    if (null === commentForm){
        return;
    }
    console.log(commentForm);
    commentForm.addEventListener('submit', async (e) => {

        e.preventDefault();// traitement de l'evement arreter//
        const response = await fetch('/ajax/comments', { //  pour attendre la reponse await fetch('/movies')lance une requête HTTP à l' '/movies'URL. Étant donné que le awaitmot clé est présent, la fonction asynchrone est suspendue jusqu'à ce que la demande se termine.//
            method: 'POST',
            body: new FormData(e.target)
        });// target cible de l'url ou l'on veut enmener les données//
        if(!response.ok) {
            return;
        };
        const json = await response.json();
        
        if (json.code ==='COMMENT_ADDED_SUCESSFULLY'){
            const commentList = document.querySelector('.comment-list');
            const commentCount = document.querySelector('.comment-count');
            const commentContent = document.querySelector('#comment_content');
            commentList.insertAdjacentHTML(beforeend, json.message);
            commentList.lastElementChild.scrollIntoView();
            commentCount.innerText = json.numberOfComments;//La innerTextpropriété définit ou renvoie le contenu textuel d'un élément.//
            commentContent.value ='';
        } 
    })
}

}
//npm run watch pour compiler les fichiers//