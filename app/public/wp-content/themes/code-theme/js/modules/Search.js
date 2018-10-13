import $ from 'jquery';

class Search {
    // 1. Describe and create/initiate our object
    constructor() {
        this.addSearchHtml();
        this.resultsDiv = $('#search-overlay__results');
        this.openButton = $('.js-search-trigger');
        this.closeButton = $('.search-overlay__close');
        this.searchOverlay = $('.search-overlay');
        this.searchField = $('#search-term');
        this.events();
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.typingTimer;
    }

    // 2. Handle events
    events() {
        this.openButton.on('click', this.openOverlay.bind(this));
        this.closeButton.on('click', this.closeOverlay.bind(this));
        $(document).on('keydown', this.keyPressDispatcher.bind(this));
        this.searchField.on('keyup', this.typingLogic.bind(this));
    }

    // 3. Methods

    typingLogic() {
        if (this.searchField.val() != this.previousValue) {
            clearTimeout(this.typingTimer);
            
            if (this.searchField.val()) {
                if (!this.isSpinnerVisible) {
                    this.resultsDiv.html('<div class="spinner-loader"></div>')
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 750);
            } else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }
        }

        this.previousValue = this.searchField.val();
    }

    getResults() {
        var query = this.searchField.val();
            $.getJSON(`${code_university_data.root_url}/wp-json/university/v1/search?term=${query}`, (results) => {
                this.resultsDiv.html(`
                    <div class='row'>
                        <div class='one-third'>
                            <h2 class="search-overlay__section-title">General Information</h2>
                            ${results.general_info.length ? '<ul class="link-list min-list">' : '<p>No results found</p>'}
                                ${results.general_info.map(post => `<li><a href="${post.permalink}">${post.title}</a> ${post.post_type == 'post' ? `by ${post.author_name}` : '' }</li>`).join('')}
                            ${results.general_info.length ? '</ul>' : ''}
                        </div>
                        <div class='one-third'>
                            <h2 class="search-overlay__section-title">Programs</h2>
                            ${results.programs.length ? '<ul class="link-list min-list">' : `<p>No programs found</p><a href="${code_university_data.root_url}/programs">View All Programs</a>`}
                                ${results.programs.map(post => `<li><a href="${post.permalink}">${post.title}</a></li>`).join('')}
                            ${results.programs.length ? '</ul>' : ''}
                            <h2 class="search-overlay__section-title">Professors</h2>
                            ${results.professors.length ? '<ul class="professor-cards">' : `<p>No professors found</p><a href="${code_university_data.root_url}/professors">View All Professors</a>`}
                                ${results.professors.map(post => `
                                <li class="professor-card__list-item">
                                <a class="professor-card" href="${post.permalink}">
                                    <img class="professor-card__image" src="${post.image}" alt="">
                                    <span class="professor-card__name">${post.title}</span>
                                </a>
                            </li>
                                `).join('')}
                            ${results.professors.length ? '</ul>' : ''}
                        </div>
                        <div class='one-third'>
                            <h2 class="search-overlay__section-title">Campuses</h2>
                            ${results.campuses.length ? '<ul class="link-list min-list">' : `<p>No campuses found</p><a href="${code_university_data.root_url}/campuses">View All Campuses</a>`}
                                ${results.campuses.map(post => `<li><a href="${post.permalink}">${post.title}</a></li>`).join('')}
                            ${results.campuses.length ? '</ul>' : ''}

                            <h2 class="search-overlay__section-title">Events</h2>
                            ${results.events.length ? '' : `<p>No events found</p><a href="${code_university_data.root_url}/events">View All Events</a>`}
                                ${results.events.map(post => `
                                    <div class="event-summary">
                                    <a class="event-summary__date t-center" href="${post.permalink}">
                                                <span class="event-summary__month">${post.month}</span>
                                        <span class="event-summary__day">${post.day}</span>
                                    </a>
                                    <div class="event-summary__content">
                                        <h5 class="event-summary__title headline headline--tiny"><a href="${post.permalink}">${post.title}</a></h5>
                                        <p>${post.description}<a href="${post.permalink}" class="nu gray">Learn more</a></p>
                                    </div>
                                </div>
                                `).join('')}
                            ${results.events.length ? '</ul>' : ''}
                        </div>
                    </div>
                `);
            });
            this.isSpinnerVisible = false;
    };

    keyPressDispatcher(e) {
        if (e.keyCode === 83 && !this.isOverlayOpen && !$('input, textarea').is(':focus')) {
            this.openOverlay();
        }
        if (e.keyCode === 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    openOverlay() {
        this.searchOverlay.addClass('search-overlay--active');
        $('body').addClass('body-no-scroll');
        this.resultsDiv.html('');
        this.searchField.val('');
        setTimeout(() => this.searchField.focus(), 350);
        console.log('open')
        this.isOverlayOpen = true; 
    }

    closeOverlay() {
        this.searchOverlay.removeClass('search-overlay--active');
        $('body').removeClass('body-no-scroll');
        console.log('close');
        this.isOverlayOpen = false;
    }

    addSearchHtml() {
        $('body').append(`
            <div class="search-overlay">
                <div class="search-overlay__top">
                    <div class="container">
                        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                        <input type="text" id="search-term" class="search-term" placeholder="What are you looking for?">
                        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="container">
                    <div id="search-overlay__results">
                    </div>
                </div>
            </div>
        `);
    }
    
}

export default Search;