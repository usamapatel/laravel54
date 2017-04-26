(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'https://laravel54.dev',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"health\/panel","name":"pragmarx.health.panel","action":"PragmaRX\Health\Http\Controllers\Health@panel"},{"host":null,"methods":["GET","HEAD"],"uri":"health\/check","name":"pragmarx.health.check","action":"PragmaRX\Health\Http\Controllers\Health@check"},{"host":null,"methods":["GET","HEAD"],"uri":"health\/string","name":"pragmarx.health.string","action":"PragmaRX\Health\Http\Controllers\Health@string"},{"host":null,"methods":["GET","HEAD"],"uri":"health.\/resource\/{name}","name":"pragmarx.health.resource","action":"PragmaRX\Health\Http\Controllers\Health@resource"},{"host":null,"methods":["GET","HEAD"],"uri":"health\/broadcasting\/callback\/{secret}","name":"pragmarx.health.broadcasting.callback","action":"PragmaRX\Health\Http\Controllers\Broadcasting@callback"},{"host":null,"methods":["GET","HEAD"],"uri":"arrilot\/load-widget","name":null,"action":"Arrilot\Widgets\Controllers\WidgetController@showWidget"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/open","name":"debugbar.openhandler","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@handle"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css","action":"Barryvdh\Debugbar\Controllers\AssetController@css"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js","action":"Barryvdh\Debugbar\Controllers\AssetController@js"},{"host":null,"methods":["GET","HEAD"],"uri":"enveditor","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@overview"},{"host":null,"methods":["POST"],"uri":"enveditor\/add","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@add"},{"host":null,"methods":["POST"],"uri":"enveditor\/update","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"enveditor\/createbackup","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@createBackup"},{"host":null,"methods":["GET","HEAD"],"uri":"enveditor\/deletebackup\/{timestamp}","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@deleteBackup"},{"host":null,"methods":["GET","HEAD"],"uri":"enveditor\/restore\/{backuptimestamp}","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@restore"},{"host":null,"methods":["POST"],"uri":"enveditor\/delete","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@delete"},{"host":null,"methods":["GET","HEAD"],"uri":"enveditor\/download\/{filename?}","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@download"},{"host":null,"methods":["POST"],"uri":"enveditor\/upload","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@upload"},{"host":null,"methods":["GET","HEAD"],"uri":"enveditor\/getdetails\/{timestamp?}","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@getDetails"},{"host":null,"methods":["GET","HEAD"],"uri":"enveditor\/test","name":null,"action":"Brotzka\DotenvEditor\Http\Controller\EnvController@test"},{"host":null,"methods":["GET","HEAD"],"uri":"langman","name":null,"action":"Themsaid\LangmanGUI\LangmanController@index"},{"host":null,"methods":["POST"],"uri":"langman\/sync","name":null,"action":"Themsaid\LangmanGUI\LangmanController@sync"},{"host":null,"methods":["POST"],"uri":"langman\/save","name":null,"action":"Themsaid\LangmanGUI\LangmanController@save"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisterController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisterController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"password.request","action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"password.email","action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":"password.reset","action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"home","name":null,"action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"teams","name":"teams.index","action":"App\Http\Controllers\Teamwork\TeamController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/create","name":"teams.create","action":"App\Http\Controllers\Teamwork\TeamController@create"},{"host":null,"methods":["POST"],"uri":"teams\/teams","name":"teams.store","action":"App\Http\Controllers\Teamwork\TeamController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/edit\/{id}","name":"teams.edit","action":"App\Http\Controllers\Teamwork\TeamController@edit"},{"host":null,"methods":["PUT"],"uri":"teams\/edit\/{id}","name":"teams.update","action":"App\Http\Controllers\Teamwork\TeamController@update"},{"host":null,"methods":["DELETE"],"uri":"teams\/destroy\/{id}","name":"teams.destroy","action":"App\Http\Controllers\Teamwork\TeamController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/switch\/{id}","name":"teams.switch","action":"App\Http\Controllers\Teamwork\TeamController@switchTeam"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/members\/{id}","name":"teams.members.show","action":"App\Http\Controllers\Teamwork\TeamMemberController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/members\/resend\/{invite_id}","name":"teams.members.resend_invite","action":"App\Http\Controllers\Teamwork\TeamMemberController@resendInvite"},{"host":null,"methods":["POST"],"uri":"teams\/members\/{id}","name":"teams.members.invite","action":"App\Http\Controllers\Teamwork\TeamMemberController@invite"},{"host":null,"methods":["DELETE"],"uri":"teams\/members\/{id}\/{user_id}","name":"teams.members.destroy","action":"App\Http\Controllers\Teamwork\TeamMemberController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/accept\/{token}","name":"teams.accept_invite","action":"App\Http\Controllers\Teamwork\AuthController@acceptInvite"},{"host":null,"methods":["GET","HEAD"],"uri":"decompose","name":null,"action":"\Lubusin\Decomposer\Controllers\DecomposerController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"log-viewer","name":"log-viewer::dashboard","action":"Arcanedev\LogViewer\Http\Controllers\LogViewerController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"log-viewer\/logs","name":"log-viewer::logs.list","action":"Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs"},{"host":null,"methods":["DELETE"],"uri":"log-viewer\/logs\/delete","name":"log-viewer::logs.delete","action":"Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete"},{"host":null,"methods":["GET","HEAD"],"uri":"log-viewer\/logs\/{date}","name":"log-viewer::logs.show","action":"Arcanedev\LogViewer\Http\Controllers\LogViewerController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"log-viewer\/logs\/{date}\/download","name":"log-viewer::logs.download","action":"Arcanedev\LogViewer\Http\Controllers\LogViewerController@download"},{"host":null,"methods":["GET","HEAD"],"uri":"log-viewer\/logs\/{date}\/{level}","name":"log-viewer::logs.filter","action":"Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

