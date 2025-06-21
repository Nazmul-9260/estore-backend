    $(document).ready(function() {
        $('li').removeClass('active pcoded-trigger');
        $('a').removeClass('active pcoded-trigger');
        $('.menu-link').each((i, e) => {
            //console.log(e);
            var lastVisitedLinkId = localStorage.getItem('lastVisitedLinkId');
            // console.log('last++', lastVisitedLink);
            var linkId = $(e).prop('id');
            //console.log(linkId);
            if (linkId == lastVisitedLinkId) {

                $(e).parent('li').addClass('active');
                var lastLink = $(e);
                // Add 'active' class to the link's parent 'li'
                lastLink.parent('li').addClass('active');

                // Add 'active' and 'pcoded-trigger' classes to all the parent elements with 'pcoded-hasmenu'
                lastLink.parents('li.pcoded-hasmenu').addClass('active pcoded-trigger');
            }

            $(e).on('click', function(event) {
                event.preventDefault();
                var visitedLinkId = $(this).prop('id');
                var uri = $(this).attr('href');
                var visitedLink = uri;
                // console.log(uri);
                localStorage.setItem('lastVisitedLink', visitedLink);
                localStorage.setItem('lastVisitedLinkId', visitedLinkId);
                // return 1 = 1;
                window.location.href = uri;
            })
        })
    })