const previewProduct = {
    productID: document.querySelector('.product--preview').getAttribute('data-id'),
    init(){
        this.addButton = document.querySelector('.button--addToCart');
        if(this.addButton != null) this.addButton.addEventListener('click', this.addToCart.bind(this));
    },
    addToCart(){
        const data = new FormData();
        data.append('product_id', this.productID);
        fetch('php/addToCart.php', {
            method: 'post',
            body: data,
        }).then(res=> this.createMessage());
    },
    createMessage(){
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message');

        const header = document.createElement('h1');
        header.classList.add('message--header');
        header.innerHTML = 'Dodano do koszyka';

        const product = document.createElement('div');
        product.classList.add('message--product');

        const productImg= new Image();
        productImg.classList.add('message--product-img');
        productImg.src = document.querySelector('.preview--img').getAttribute('src');

        const productName = document.createElement('span');
        productName.classList.add('message--product-name');
        productName.innerHTML = document.querySelector('.preview--name').innerHTML;

        const nav = document.createElement('div');
        nav.classList.add('message--nav');

        const cartLink = document.createElement('a');
        cartLink.classList.add('message--link');
        cartLink.setAttribute('href', 'cart.php');
        cartLink.innerHTML="Przejdź do koszyka";
    
        const continueLink = document.createElement('span');
        continueLink.classList.add('message--link');
        continueLink.innerHTML="Kontynuuj zakupy";
        continueLink.addEventListener('click', e=>{
            messageDiv.style='transform: translate(-50%) scale(0)';
            setTimeout(()=>{
                messageDiv.remove();
            },300);
            
        });
        
        nav.append(continueLink);
        nav.append(cartLink);
        product.append(productImg);
        product.append(productName);
        messageDiv.append(header);
        messageDiv.append(product);
        messageDiv.append(nav);
        document.querySelector('BODY').append(messageDiv);
        setTimeout(()=>{
            messageDiv.style='transform: translate(-50%) scale(1)';
        },100);
    }
}

previewProduct.init();