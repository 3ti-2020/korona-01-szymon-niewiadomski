export class Product{
    constructor(product){
        this.id = product['product_id'];
        this.name = product.name;
        this.description = product.description;
        this.category = product.category;
        this.price = product.price;
        this.img = product.img;
        this.count = product.count;

        if(this.count == undefined) this.item = this.createItem();
        else this.row = this.createRow();
    }
    createItem(){
        const anchor = document.createElement('a');
        anchor.setAttribute('href', 'product.php?product=' + this.id);
        anchor.classList.add('product--link');

        const li = document.createElement('li');
        li.classList.add('product');

        const img = new Image();
        img.src= `img/products/${this.img}.jpg`;
        img.classList.add('product--img');
        li.append(img);

        const div = document.createElement('div');
        div.classList.add('product--text');
        li.append(div);

        const name = document.createElement('p');
        name.classList.add('product--name');
        name.innerHTML = this.name;
        div.append(name);

        const price = document.createElement('p');
        price.classList.add('product--price');
        price.innerHTML = this.price + ' zł';
        div.append(price);

        anchor.append(li);
        return anchor;
    }
    createRow(){
        const row = document.createElement('tr');
        row.classList.add('cart--row');

        const imgColumn = document.createElement('td');
        const img = new Image();
        img.src=`img/products/${this.img}.jpg`;
        img.classList.add('cart--product-img')
        imgColumn.append(img);
        row.append(imgColumn);

        const productLink = document.createElement('a');
        productLink.setAttribute('href', 'product.php?product=' + this.id);
        productLink.classList.add('cart--product-link');
        productLink.innerHTML= this.name;

        const nameColumn = document.createElement('td');
        nameColumn.classList.add('cart--product-name');
        nameColumn.append(productLink);
        row.append(nameColumn);
        
        const priceColumn = document.createElement('td');
        priceColumn.classList.add('cart--product-price');
        priceColumn.innerHTML = this.price + ' zł';
        row.append(priceColumn);

        const countColumn = document.createElement('td');
        const counter = document.createElement('input');
        counter.setAttribute('type', 'number');
        counter.setAttribute('value', this.count);
        counter.setAttribute('max', '99');
        counter.setAttribute('min', '1');
        counter.classList.add('cart--counter');
        countColumn.append(counter);
        row.append(countColumn);
        
        const deleteColumn = document.createElement('td');
        const cross = document.createElement('div');
        cross.classList.add('cart--cross');
        deleteColumn.append(cross);
        row.append(deleteColumn);

        return {
            element: row,
            cross: cross,
            counter: counter
        }
    }
}