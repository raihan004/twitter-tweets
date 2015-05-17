(function ($) {
    var Twitter = {
        config: {
            count: 5,
            screen_name: 'raihan004'
        },
        init: function (config) {
            $.extend(this.config, config);
            this.url = 'js/api/tweets_json.php?count=' + this.config.count + '&screen_name=' + this.config.screen_name;
            this.template = this.config.template;
            this.container = this.config.container;

            //            console.log(this.url);
            this.fetch();
        },
        fetch: function () {
            var self = this;
            $.getJSON(this.url, function (data) {
                //                co nsole.log(data);
                self.tweets = $.map(data, function (tweet) {
                    return {
                        author: tweet.user.screen_name,
                        tweet: tweet.text,
                        thumb: tweet.user.profile_image_url,
                        link: 'https://twitter.com/' + tweet.user.screen_name + '/status/' + tweet.id_str

                    };
                });
                //                console.log(tweets);
                self.attachTemplate();
            });

        },
        attachTemplate: function () {
            console.log(this.tweets);
            var temp = Handlebars.compile(this.template);
            this.container.append(temp(this.tweets));
        }

    };

    Twitter.init({
        template: $('#tweets-tempalte').html(),
        container: $('ul.tweets'),
        screen_name: 'raihan004',
        count: 3
    });


}(window.jQuery));
