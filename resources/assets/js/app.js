$(document).ready((function() {
    let e;
    $(".menu-item").hover((function() {
        clearTimeout(e), $(this).find(".menu-item-children").removeClass("hidden")
    }), (function() {
        const t = $(this);
        e = setTimeout((function() {
        t.find(".menu-item-children").addClass("hidden")
        }), 300)
    })), $(".menu-item-children").hover((function() {
      clearTimeout(e)
    }), (function() {
      $(this).addClass("hidden")
    })), $(".toggle-dropdown-menu").on("click", (function() {
      $(this).closest('.group-menuItem').find(".dropdown-menu").toggleClass("hidden"), $(this).find("svg").toggleClass("rotate-180")
    })), $(".btn-toggle-sidebar").on("click", (function() {
      $(".sidebar-mobile").toggleClass("hidden")
    }));

    $(".btn-search").on("click", function() {
        if ($(window).width() < 1132) {
            $("#search-container").toggleClass("hidden");
        } else {
            window.location.href = "/?search=" + $(".input-search").val();
        }
    });

    $('.btn-login').on("click", function() {
        $(this).addClass("bg-primary hover:bg-primary-400 text-primary-foreground");
        $(this).removeClass("bg-default lg:hover:bg-default-400");
        $('.btn-register').removeClass("bg-primary hover:bg-primary-400 text-primary-foreground").addClass("bg-default lg:hover:bg-default-40");
        $('#form-login').removeClass("hidden");
        $('#form-register').addClass("hidden");
    });

    $('.btn-register').on("click", function() {
        $(this).addClass("bg-primary hover:bg-primary-400 text-primary-foreground");
        $(this).removeClass("bg-default lg:hover:bg-default-400");
        $('.btn-login').removeClass("bg-primary hover:bg-primary-400 text-primary-foreground").addClass("bg-default lg:hover:bg-default-40");
        $('#form-register').removeClass("hidden");
        $('#form-login').addClass("hidden");
    });

    $(document).on('submit', '#login-form', function(e) {
        e.preventDefault();

        const username = $(this).find('input[name="username"]').val();
        const password = $(this).find('input[name="password"]').val();

        if (username === '') {
            $(this).find('input[name="username"]').after('<p class="typography font-content text-[14px] leading-[normal] font-normal text-red-500">Vui lòng không để trống</p>');
        }

        if (password === '') {
            $(this).find('input[name="password"]').after('<p class="typography font-content text-[14px] leading-[normal] font-normal text-red-500">Vui lòng không để trống</p>');
        }

        if (username !== '' && password !== '') {
            $.ajax({
                url: '/auth/login',
                method: 'POST',
                data: {
                    username: username,
                    password: password,
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        window.location.reload();
                    } else {
                        alert('Tài khoản hoặc mật khẩu không chính xác');
                    }
                }
            });
        }
    });

    $(document).on('submit', '#form-register', function(e) {
        e.preventDefault();

        const name = $(this).find('input[name="name"]').val();
        const email = $(this).find('input[name="email"]').val();
        const password = $(this).find('input[name="password"]').val();
        const confirmPassword = $(this).find('input[name="confirmPassword"]').val();

        if (name === '') {
            $(this).find('input[name="name"]').after('<p class="typography font-content text-[14px] leading-[normal] font-normal text-red-500">Vui lòng không để trống</p>');
        }

        if (email === '') {
            $(this).find('input[name="email"]').after('<p class="typography font-content text-[14px] leading-[normal] font-normal text-red-500">Vui lòng không để trống</p>');
        }

        if (password === '') {
            $(this).find('input[name="password"]').after('<p class="typography font-content text-[14px] leading-[normal] font-normal text-red-500">Vui lòng không để trống</p>');
        }

        if (confirmPassword === '') {
            $(this).find('input[name="confirmPassword"]').after('<p class="typography font-content text-[14px] leading-[normal] font-normal text-red-500">Vui lòng không để trống</p>');
        }

        if (password !== confirmPassword) {
            $(this).find('input[name="confirmPassword"]').after('<p class="typography font-content text-[14px] leading-[normal] font-normal text-red-500">Mật khẩu không khớp</p>');
        }

        if (name !== '' && email !== '' && password !== '' && confirmPassword !== '') {
            $.ajax({
                url: '/auth/register',
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    password: password,
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        alert('Đăng ký thành công');
                        $('#form-register').addClass('hidden');
                        $('#form-login').removeClass('hidden');
                    } else {
                        alert('Tài khoản đã tồn tại');
                    }
                }
            });
        }
    });

    $('.btn-toggle-modal-auth').on('click', function() {
        $('#modal-auth').toggleClass('hidden');
    });

    $('.btn-go-to-top').on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });

    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 100) {
            $('.btn-go-to-top').removeClass('hidden');
        } else {
            $('.btn-go-to-top').addClass('hidden');
        }
    });

    tippy('.typpy', {
        content: (reference) => {
            const genres = Array.from(reference.querySelectorAll('a.genre'));
            const template = `
                <div class="relative w-full h-full bg-default border border-foreground-600/10 p-[6px] rounded-lg overflow-hidden lg:p-4 duration-300 hover:scale-[114%] group/hoverFilm">
                    <div class="absolute top-0 inset-x-0 overflow-hidden">
                        <div class="relative aspect-[228/304]">
                            <img alt="${reference.querySelector('img').alt}"
                                 class="object-cover"
                                 src="${reference.querySelector('img').getAttribute('data-original')}"
                                 style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                        </div>
                    </div>
                    <div class="absolute z-zContent inset-0 bottom-[-2px] flex flex-col">
                        <div class="block aspect-[16/9] shrink-0 relative cursor-pointer" onclick="window.location.href = '${reference.querySelector('a').getAttribute('href')}'">
                            <div class="absolute right-2 bottom-2">
                                <div class="flex items-center gap-2">
                                    <a class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-400 text-primary-foreground h-7 text-[14px] gap-1.5 aspect-square w-auto p-0" href="${reference.querySelector('a').getAttribute('href')}">
                                        <svg width="0.9em" height="1em" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.70651 19.8698L17.2865 10.8698C17.4404 10.7826 17.5684 10.6561 17.6575 10.5033C17.7465 10.3504 17.7935 10.1767 17.7935 9.99982C17.7935 9.82293 17.7465 9.6492 17.6575 9.49636C17.5684 9.34352 17.4404 9.21704 17.2865 9.12982L1.70651 0.129824C1.55449 0.0420552 1.38205 -0.00415111 1.20651 -0.00415112C1.03097 -0.00415112 0.858528 0.0420552 0.706509 0.129824C0.553904 0.217928 0.42729 0.344792 0.339487 0.497569C0.251684 0.650347 0.205809 0.823613 0.206509 0.999823L0.206508 18.9998C0.205808 19.176 0.251683 19.3493 0.339486 19.5021C0.427289 19.6549 0.553903 19.7817 0.706508 19.8698C0.858527 19.9576 1.03097 20.0038 1.20651 20.0038C1.38204 20.0038 1.55449 19.9576 1.70651 19.8698Z" fill="currentColor"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="grow bg-default min-h-0 relative overflow-hidde px-4 pt-2">
                            <div>
                                <a class="block hover:text-primary" href="${reference.querySelector('a').getAttribute('href')}">
                                    <p class="typography font-content text-[1rem] leading-[24px] font-medium line-clamp-1">${reference.querySelector('h3').textContent}</p>
                                </a>
                            </div>
                            <div class="px-0 py-2">
                                <div class="flex items-center">
                                    <ul class="flex items-center">
                                        <li class="ml-1.5 pl-1.5 group/infoItem relative">
                                            <p class="typography font-content text-[12px] leading-[normal] font-normal">${reference.querySelector('div.publish_year').textContent}</p>
                                        </li>
                                        <li class="ml-1.5 pl-1.5 group/infoItem relative">
                                            <p class="typography font-content text-[12px] leading-[normal] font-normal">${reference.querySelector('div.episodes').textContent} Tập</p>
                                            <div class="absolute top-1/2 -translate-y-1/2 left-0 h-2 w-[1px] bg-foreground-700"></div>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="flex mt-2 gap-1 flex-wrap">
                                    ${genres.map(genre => `
                                        <li><a class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 bg-default-400 hover:bg-default-300 h-5 px-2 text-[12px]" href="${genre.getAttribute('href')}">${genre.textContent}</a></li>
                                    `).join('')}
                                </ul>
                                <div class="mt-2">
                                    <div class="typography font-content text-[12px] font-normal text-foreground-600 leading-[1.5] line-clamp-4">
                                        ${reference.querySelector('div.content').textContent}
                                    </div>
                                </div>
                            </div>
                            <div class="flex absolute pb-4 pt-4 pr-4 inset-x-0 bottom-0 justify-end" style="background-image: linear-gradient(to bottom, transparent, hsl(var(--color-default)), hsl(var(--color-default)));">
                                <a class="text-primary flex gap-1 items-center" aria-label="Xem thêm" href="${reference.querySelector('a').getAttribute('href')}">
                                    <p class="typography font-content text-[12px] leading-[normal] font-normal">Xem thêm</p>
                                    <svg width="0.667em" height="1em" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[10px]"><path d="M6.83 5.29001L2.59 1.05001C2.49704 0.956281 2.38644 0.881887 2.26458 0.831118C2.14272 0.780349 2.01202 0.754211 1.88 0.754211C1.74799 0.754211 1.61729 0.780349 1.49543 0.831118C1.37357 0.881887 1.26297 0.956281 1.17 1.05001C0.983753 1.23737 0.879211 1.49082 0.879211 1.75501C0.879211 2.0192 0.983753 2.27265 1.17 2.46001L4.71 6.00001L1.17 9.54001C0.983753 9.72737 0.879211 9.98082 0.879211 10.245C0.879211 10.5092 0.983753 10.7626 1.17 10.95C1.26344 11.0427 1.37426 11.116 1.4961 11.1658C1.61794 11.2155 1.7484 11.2408 1.88 11.24C2.01161 11.2408 2.14207 11.2155 2.26391 11.1658C2.38575 11.116 2.49656 11.0427 2.59 10.95L6.83 6.71001C6.92373 6.61705 6.99813 6.50645 7.04889 6.38459C7.09966 6.26273 7.1258 6.13202 7.1258 6.00001C7.1258 5.868 7.09966 5.73729 7.04889 5.61543C6.99813 5.49357 6.92373 5.38297 6.83 5.29001Z" fill="currentColor"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
            return template;
        },
        allowHTML: true,
        interactive: true,
        theme: 'custom',
        animation: 'fade',
        arrow: false,
        placement: 'top',
        appendTo: 'parent',
        popperOptions: {
            modifiers: [
                {
                    name: 'computeStyles',
                    options: {
                        adaptive: false,
                        gpuAcceleration: false
                    }
                },
                {
                    name: 'applyStyles',
                    fn: ({ state }) => {
                        const styles = state.styles.popper;
                        styles.transform = 'none';
                        styles.top = '0';
                        styles.left = '0';
                        return state;
                    }
                }
            ]
        },
        onShow(instance) {
            const tooltip = instance.popper;

            tooltip.style.transform = 'none';
            tooltip.style.setProperty('transform', 'none', 'important');
            tooltip.style.position = 'absolute';
            tooltip.style.top = '100%';
            tooltip.style.left = '0';
            tooltip.style.width = '100%';
            tooltip.style.height = '100%';
            tooltip.style.zIndex = '10';

            setTimeout(() => {
                tooltip.style.transform = 'none';
                tooltip.style.setProperty('transform', 'none', 'important');
            }, 0);
        }
    });

    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 100) {
            $('.btn-go-to-top').removeClass('hidden');
        } else {
            $('.btn-go-to-top').addClass('hidden');
        }

        if ($(window).scrollTop() > 50) {
            $('#overlay_header').removeClass('bg-transparent').addClass('bg-background');
        } else {
            $('#overlay_header').removeClass('bg-background').addClass('bg-transparent');
        }
    });

    $('.btn-toggle-profile-menu').on('click', function() {
        $('#profile-menu').toggleClass('hidden');
    });
}));
