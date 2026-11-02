const views = {
    home: 'home.html',
    catalog: 'catalog.html',
    categories: 'categories.html',
    book: 'book.html',
    cart: 'cart.html',
    login: 'login.html',
    register: 'register.html',
    orders: 'orders.html',
    profile: 'profile.html',
    admin: 'admin.html'
};

const books = [
    { id: 'a-tale-of-two-cities', title: 'A Tale of Two Cities', author: 'Charles Dickens', cover: 'assets/covers/a-tale-of-two-cities.jpg', price: '14.99', rating: '3.88' },
    { id: 'the-little-prince', title: 'The Little Prince', author: 'Antoine de Saint-Exupéry', cover: 'assets/covers/the-little-prince.jpg', price: '12.99', rating: '4.34' },
    { id: 'the-da-vinci-code', title: 'The Da Vinci Code', author: 'Dan Brown', cover: 'assets/covers/the-da-vinci-code.jpg', price: '18.99', rating: '3.94' },
    { id: 'the-alchemist', title: 'The Alchemist', author: 'Paulo Coelho', cover: 'assets/covers/the-alchemist.jpg', price: '15.99', rating: '3.92' },
    { id: 'harry-potter-chamber-of-secrets', title: 'Harry Potter and the Chamber of Secrets', author: 'J.K. Rowling', cover: 'assets/covers/harry-potter-chamber-of-secrets-user.png', price: '19.99', rating: '4.43' },
    { id: 'the-girl-with-the-dragon-tattoo', title: 'The Girl with the Dragon Tattoo', author: 'Stieg Larsson', cover: 'assets/covers/the-girl-with-the-dragon-tattoo.jpg', price: '17.99', rating: '4.18' },
    { id: 'the-name-of-the-rose', title: 'The Name of the Rose', author: 'Umberto Eco', cover: 'assets/covers/the-name-of-the-rose.jpg', price: '16.99', rating: '4.14' },
    { id: 'the-shadow-of-the-wind', title: 'The Shadow of the Wind', author: 'Carlos Ruiz Zafón', cover: 'assets/covers/the-shadow-of-the-wind-user.png', price: '16.99', rating: '4.31' },
    { id: 'the-girl-on-the-train', title: 'The Girl on the Train', author: 'Paula Hawkins', cover: 'assets/covers/the-girl-on-the-train.jpg', price: '15.99', rating: '3.96' },
    { id: 'the-book-thief', title: 'The Book Thief', author: 'Markus Zusak', cover: 'assets/covers/the-book-thief.jpg', price: '14.99', rating: '4.39' },
    { id: 'slumdog-millionaire', title: 'Slumdog Millionaire', author: 'Vikas Swarup', cover: 'assets/covers/slumdog-millionaire.jpg', price: '15.99', rating: '4.03' },
    { id: 'the-great-gatsby', title: 'The Great Gatsby', author: 'F. Scott Fitzgerald', cover: 'assets/covers/the-great-gatsby-goodreads.jpg', price: '12.99', rating: '3.93' },
    { id: 'a-thousand-splendid-suns', title: 'A Thousand Splendid Suns', author: 'Khaled Hosseini', cover: 'assets/covers/a-thousand-splendid-suns-goodreads.jpg', price: '17.99', rating: '4.46' },
    { id: 'the-stranger', title: 'The Stranger', author: 'Albert Camus', cover: 'assets/covers/the-stranger-goodreads.jpg', price: '13.99', rating: '4.03' },
    { id: 'pride-and-prejudice', title: 'Pride and Prejudice', author: 'Jane Austen', cover: 'assets/covers/pride-and-prejudice-goodreads.jpg', price: '14.99', rating: '4.30' }
];

const featuredBookIds = [
    'the-shadow-of-the-wind',
    'a-thousand-splendid-suns',
    'slumdog-millionaire',
    'the-book-thief',
    'harry-potter-chamber-of-secrets',
    'the-little-prince',
    'the-girl-with-the-dragon-tattoo',
    'a-tale-of-two-cities',
    'pride-and-prejudice',
    'the-name-of-the-rose'
];

const app = document.querySelector('#app');
const viewCache = new Map();

async function loadView(file) {
    if (!viewCache.has(file)) {
        const request = fetch(`views/${file}`).then(response => {
            if (!response.ok) throw new Error('View could not be loaded');
            return response.text();
        });
        viewCache.set(file, request);
    }

    try {
        return await viewCache.get(file);
    } catch {
        viewCache.delete(file);
        throw new Error('View could not be loaded');
    }
}

function currentView() {
    const requested = window.location.hash.slice(1).split('/')[0];
    return views[requested] ? requested : 'home';
}

function bookCard(book) {
    return `<article class="book-card">
        <a class="cover-wrap" href="#book/${book.id}" aria-label="View ${book.title}">
            <img class="book-cover" src="${book.cover}" alt="Cover of ${book.title}">
        </a>
        <a href="#book/${book.id}" class="book-title">${book.title}</a>
        <div class="book-author">${book.author}</div>
        <div class="book-meta"><span class="book-price">$${book.price}</span><span class="rating" aria-label="Rated ${book.rating} out of 5">★ ${book.rating}</span></div>
    </article>`;
}

function activeBook() {
    const id = window.location.hash.split('/')[1];
    return books.find(book => book.id === id) || books[0];
}

async function renderView() {
    const view = currentView();
    const file = views[view];
    app.innerHTML = '<div class="loading-state">Loading…</div>';

    try {
        app.innerHTML = await loadView(file);
        document.querySelectorAll('[data-nav-link]').forEach(link => {
            if (link.getAttribute('href') === `#${view}`) link.setAttribute('aria-current', 'page');
            else link.removeAttribute('aria-current');
        });
        fillView(view);
        app.focus({ preventScroll: true });
        document.querySelector('.primary-navigation').classList.remove('is-open');
        document.querySelector('.menu-toggle').setAttribute('aria-expanded', 'false');
    } catch {
        app.innerHTML = '<div class="error-state"><h1>Page unavailable</h1><p>Run this project through a local web server to view the bookstore pages.</p></div>';
    }
}

function fillView(view) {
    if (view === 'home' || view === 'catalog') {
        const grid = document.querySelector('[data-book-grid]');
        const featuredBooks = view === 'home'
            ? featuredBookIds.map(id => books.find(book => book.id === id)).filter(Boolean)
            : books;
        if (grid) grid.innerHTML = featuredBooks.map(bookCard).join('');
        const count = document.querySelector('[data-result-count]');
        if (count) count.textContent = `${featuredBooks.length} books`;
    }

    if (view === 'book') {
        const book = activeBook();
        document.querySelector('[data-book-cover]').innerHTML = `<img class="detail-book-cover" src="${book.cover}" alt="Cover of ${book.title}">`;
        document.querySelector('[data-book-title]').textContent = book.title;
        document.querySelector('[data-book-author]').textContent = `by ${book.author}`;
        document.querySelector('[data-book-rating]').textContent = `★ ${book.rating} / 5`;
        document.querySelector('[data-book-price]').textContent = `$${book.price}`;
    }
}

document.addEventListener('click', event => {
    const menuButton = event.target.closest('.menu-toggle');
    if (menuButton) {
        const navigation = document.querySelector('.primary-navigation');
        const isOpen = navigation.classList.toggle('is-open');
        menuButton.setAttribute('aria-expanded', String(isOpen));
    }

});

window.addEventListener('hashchange', renderView);
renderView();
