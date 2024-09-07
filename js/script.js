var sidebarIsOpen = true;

toggleBtn.addEventListener( 'click', (event) => {
    event.preventDefault();

    if(sidebarIsOpen){
        sidebar.style.width= '10%';
        sidebar.style.transition= '0.3s all';
        dashboard_container.style.width= '90%';
        logo.style.fontsize = '60px';
        userimage.style.width= '60px';

        menuIcons= document.getElementsByClassName('menuText');
        for(var i=0; i < menuIcons.length; i++){
        menuIcons[i].style.display = 'none';
    }
    document.getElementsByClassName('menu_list')[0].style.textAlign = 'center';
    sidebarIsOpen = false;    
    } else {
        sidebar.style.width= '20%';
        dashboard_container.style.width= '80%';
        logo.style.fontsize= '60px';
        userimage.style.width= '60px';

        menuIcons= document.getElementsByClassName('menuText');
        for(var i=0; i< menuIcons.length; i++){
        menuIcons[i].style.display = 'inline-block';
    }
    document.getElementsByClassName('menu_list')[0].style.textAlign = 'left';
    }
    sidebarIsOpen = true;    
});

//Submenu show/ hide function
document.addEventListener('click', function(e){
    let clickedEl = e.target;

    if(clickedEl.classList.contains('showhideSubMenu')){
        let subMenu = clickedEl.closest('li').querySelector('.subMenus');
        let mainMenuIcon = clickedEl.closest('li').querySelector('.mainMenuIconArrow');

        //Close all submenus.
        let subMenus = document.querySelectorAll('.subMenus');
        subMenus.forEach((sub) => {
            if(subMenu !== sub) sub.style.display = 'none';
        });
        
        //Call function to show and hide submenu
        showhideSubMenu(subMenu, mainMenuIcon);
    }
});

function showhideSubMenu(subMenu, mainMenuIcon){
    //Check if there is submenu
    if(subMenu != null){
        if(subMenu.style.display === 'block') {
            subMenu.style.display = 'none';
            mainMenuIcon.classList.remove('fa-angle-up');
            mainMenuIcon.classList.add('fa-angle-down');
        } else {
            subMenu.style.display = 'block';
            mainMenuIcon.classList.remove('fa-angle-down');
            mainMenuIcon.classList.add('fa-angle-up');
        }    
    }
}

//Add / hide active class to menu
//Get the current page
//Use selector to get the current menuor submeny
//Add the active class


let pathArray = window.location.pathname.split( '/' );
let curFile = pathArray[pathArray.length -1];

let curNav = document.querySelector('a[href="./'+ curFile +'"]');
curNav.classList.add('subMenuActive');

let mainNav = curNav.closest('li.liMainMenu');
mainNav.style.background = 'rgb(123 103 107)';

let subMenu = curNav.closest('.subMenus');
let mainMenuIcon = mainNav.querySelector('i.mainMenuIconArrow');

//Call function to show and hide submenu
showhideSubMenu(subMenu,mainMenuIcon);
