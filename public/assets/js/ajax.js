/*global fetch*/

let csrf = document.querySelector('meta[name="csrf-token"]').content;
var search = document.getElementById('q');
var categories = document.getElementsByClassName("category");
var category = "";
var sorting = document.getElementsByClassName("sorting");
var type = "";
var order = "";

window.addEventListener('load', () => {
    document.getElementById('pagination').addEventListener('click', handleClick);
    fetchData('fetchdata');
});

window.onpopstate = function(e) {
    if(e.state) {
        //getPage(e.state.page, e.state.params);
        console.log('page');
        console.log(e.state);
    }
};




function fetchData(page) {
    pushState('?page=' + Math.floor(Math.random() * 100));
    fetch(page, {
        method: 'POST',
        headers: {
            'Accept' : 'application/json',
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrf
        },
        body : JSON.stringify(
            {
                'search': search.value,
                'ordercategory' : category,
                'ordertype' : type,
                'orderby' : order
            }
        )
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(jsonData) {
        showData(jsonData);
    })
    .catch(function(error) {
        console.log(error);
    });
}

function handleClick(e) {
    if (e.target.classList.contains('pulsable')) {
        console.log(e.target.getAttribute('data-url'));
        fetchData(e.target.getAttribute('data-url'));
    }
}

function showData(data) {
    let body = document.getElementById('shopAjaxBody');
    let paginationDiv = document.getElementById('pagination');
    let shops = data.shops.data;
    let pagination = data.shops.links;
    let url = data.url;
    //csrf
    console.log(csrf == data.csrf,csrf, data.csrf);

    // table body
    let string = '';
    shops.forEach(shop => {
            string += `
                <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s">
                                        <!-- Product Image -->
                                        <div class="product-img">
                                            <img src="data:image/jpeg;base64,${ shop.thumbnail }" alt="">
                                            <div class="product-quicview">
                                                <a class="show" href="${url}/shop/${shop.id}"><i class="ti-plus"></i></a>
                                            </div>
                                        </div>
                                        <!-- Product Description -->
                                        <div class="product-description">
                                            <h4 class="product-price">${ shop.price }€</h4>
                                            <p>${shop.name}</p>
                                            
    			                             
                                        </div>
                                    </div>`
            ;
    });
    body.innerHTML = string;
    
    

    // pagination
    string = '';
    pagination.forEach(pag => {
        if (pag.active) {
            string += `
                <li class="page-item active" aria-current="page">
                    <span class="page-link pulsable" data-url="${pag.url}">${pag.label}</span>
                </li>
            `;
        } else if (pag.url != null) {
            string += `
                <li class="page-item">
                    <span class="page-link pulsable" data-url="${pag.url}" id="${'pag' + pag.label}">${pag.label}</span>
                </li>
            `;
        } else {
            string += `
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">${pag.label}</span>
                </li>
            `;
        }
    });
    paginationDiv.innerHTML = string;
}

function pushState(url) {
    var jsonPage = {'url': url};
    window.history.pushState(jsonPage, '', url);
}



search.addEventListener('keyup', () =>{
    fetchData('fetchdata');
});

Array.from(categories).forEach(function(element) {
      element.addEventListener('click', ()=>{
          category = element.getAttribute("data-attribute");
          fetchData('fetchdata');
      });
});

Array.from(sorting).forEach(function(element) {
      element.addEventListener('click', ()=>{
          type = element.getAttribute("data-type");
          order = element.getAttribute("data-sort");
          console.log(type, order);
          fetchData('fetchdata');
      });
});
