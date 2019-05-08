class Grid {

    /**
     * @param {string} selector
     */
    constructor (selector){
        this.activeContent = null
        this.activeRecipe = null
        this.container = document.querySelector(selector)
        if (this.container === null){
            throw new Error('L\'élement ${selector} n\'existe pas')
        }

        this.children = Array.prototype.slice.call(this.container.querySelectorAll('.grid_recipe'))
        this.children.forEach((child) => {
            child.addEventListener('click', (e) => {
                e.preventDefault()
                this.show(child)
            })
        })

        // Lorsque l'on clique sur une recette .grid_recipe
            // On supprime l'élement actif
            // On insère ce clone aprés l'élement .grid_recipe

    }

    /**
     * Affiche le contenu d'une recette
     * @param  {HTMLElement} child
     */
    show (child) {
        let offset = 0
        if (this.activeContent !== null) {
            this.slideUp(this.activeContent)
            if (this.activeContent.offsetTop < child.offsetTop) {
                offset = this.activeContent.offsetHeight
            }
        }
        if (this.activeRecipe === child ) {
            this.activeContent = null
            this.activeRecipe = null
        } else {
            let content = child.querySelector('.grid_body').cloneNode(true)
            child.after(content)
            this.slideDown(content)
            this.scrollTo(child, offset)
            this.activeContent = content
            this.activeRecipe = child
        }

    }

    /**
     * Affiche l'élement avec un effet d'animation
     * @param {HTMLElement} content
     */
    slideDown(content){
        let heigth = content.offsetHeight
        content.style.height = '0px'
        content.style.transitionDuration = '.5s'
        content.offsetHeight // force le repaint
        content.style.height = heigth + 'px'
        window.setTimeout(function () {
            content.style.height = null
        }, 500)
    }

    /**
     * Masque l'élement avec un effet d'animation
     * @param {HTMLElement} content
     */
    slideUp(content){
        let heigth = content.offsetHeight
        content.style.height = heigth + 'px'
        content.offsetHeight // force le repaint
        content.style.height = '0px'
        window.setTimeout(function () {
            content.parentNode.removeChild(content)
        }, 500)
    }

    /**
     * Fait défiler la fenêtre jusqu'à l'élement
     * @param {HTMLElement} content
     * @param {int} offset
     */
    scrollTo(content, offset = 0){
        window.scrollTo({
            behavior: 'smooth',
            left: 0,
            top: content.offsetTop - offset
        })
    }




}

new Grid('#grid')