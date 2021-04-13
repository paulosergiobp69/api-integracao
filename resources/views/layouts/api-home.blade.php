<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    
    <title>Laravel Forge | PHP Hosting For Artisans</title>

    <!-- FavIcon -->
    <link rel="icon" type="image/png" href="/favicon.png">


    <script>
        window.Forge = {"user":146777,"sitekey":"6Ld2W7gUAAAAAJNdHTgn9xy7n_J74vfWrKBcYLXx","ocean_id":"dadfc4c4528ef78184f193f26535894a6dd07bcd4411f259a47267952570e565","ocean_callback":"https:\/\/forge.laravel.com\/ocean\/callback","pusher_key":"6a37de83b9c874da7001","pusher_cluster":"mt1","stripe_key":"pk_live_gUkoQQhBuMgYv4FKjBfTlkWa"}    </script>

    <!-- Vendor Javascript -->

    </head>
<body>
<div id="app" v-cloak>
    <alert :title="alert.title"
           :message="alert.message"
           :type="alert.type"
           :auto-close="alert.autoClose"
           :confirmation-proceed="alert.confirmationProceed"
           :confirmation-cancel="alert.confirmationCancel"
           v-if="alert.type"></alert>

    <nav style="margin-bottom:35px" class="navbar navbar-expand-lg navbar-dark px-0">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="/images/forge-logo.svg"></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                
                <ul class="navbar-nav ml-auto">
                                            <dropdown>
                            <template #trigger>
                                <div class="text-white tw-cursor-pointer">
                                    <img src="https://unavatar.now.sh/paulosergiobp%40gmail.com?fallback=https%3A%2F%2Fui-avatars.com%2Fapi%3Fname%3Dpaulosergiobp%26color%3D7F9CF4%26background%3DEBF4FF" height="35" width="35" class="rounded-circle mr-2">
                                    paulosergiobp <b class="caret"></b>
                                </div>
                            </template>

                            <template #content>
                                <dropdown-link href="https://forge.laravel.com/user/profile#/authentication">Account</dropdown-link>
                                <dropdown-link href="https://forge.laravel.com/billing">Billing</dropdown-link>
                                <dropdown-link href="https://forge.laravel.com/circles">Circles</dropdown-link>
                                <dropdown-link href="https://laracasts.com/series/learn-laravel-forge" target="_blank">Tutorials</dropdown-link>
                                <dropdown-link href="https://forge.laravel.com/auth/logout">Logout</dropdown-link>
                            </template>
                        </dropdown>
                                    </ul>
            </div>
        </div>
    </nav>

    <div>
        <!--             <div id="forge-news" class="text-center">
                <strong>AWS is currently <a href="https://status.aws.amazon.com/">experiencing a DNS outage</a>. All Forge features are severely impacted.
            </div> -->
        
        <div class="container">
                <connect inline-template>
        <div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="alert alert-warning">
                        <strong>Great!</strong> Now let's connect to a source control and server provider so Forge can create servers!
                    </div>

                    
                    
                    
                    
                    
                    <div class="card card-default mb-4">
                        <div class="card-header"><h5>Just Joining A Circle?</h5></div>
                        <div class="card-body">
                            <p>If you are just joining a circle to collaborate with a friend or teammate using Forge, you can skip these steps.
                                If you want to connect to a server provider or source control provider at a later time, you may do so from your account profile.<br>
                            </p>

                        </div>

                        <div class="card-footer">
                            <div class="row mb-0 justify-content-end">
                                <div class="col-auto">
                                    <a href="/user/connect/skip-everything">
                                        <button class="btn btn-green">
                                            Skip For Now
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                                        <div class="card card-default mb-4">
                        <div class="card-header"><h5>Source Control</h5></div>
                        <div class="card-body">
                                                            <a href="/auth/github">
                                    <button class="btn btn-green">
                                        <i class="fa fa-github mr-2"></i>
                                        Connect GitHub
                                    </button>
                                </a>
                            
                            &nbsp;or&nbsp;

                                                            <a href="/auth/gitlab">
                                    <button class="btn btn-green">
                                        <i class="fa fa-gitlab mr-2"></i>
                                        Connect GitLab
                                    </button>
                                </a>
                            
                            &nbsp;or&nbsp;

                                                            <a href="/auth/bitbucket">
                                    <button class="btn btn-green">
                                        <i class="fa fa-bitbucket mr-2"></i>
                                        Connect Bitbucket
                                    </button>
                                </a>
                            
                            &nbsp;or&nbsp;

                                                            <a href="https://forge.laravel.com/user/connect/skip-source-control">
                                    <button class="btn btn-green">
                                        <i class="fa fa-git mr-2"></i>
                                        Use Custom Git Provider
                                    </button>
                                </a>
                                                    </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header"><h5>Server Providers</h5></div>

                        <div class="card-body">
                            <div class="alert alert-info">
                                We'll need the API key for at least one provider so we can build your servers. Don't worry, you can connect more providers later.<br><br>
                                <strong>Plan on only using your own Custom VPS servers? You can
                                    <a href="https://forge.laravel.com/user/connect/skip">skip this step</a>.</strong>
                            </div>

                            <div class="row providerSelector">
                                <div class="col">
                                    <a v-on:click.prevent="currentTab = 'ocean2'" href="#" class="d-flex flex-column justify-content-between providerOption" :class="{'active': currentTab == 'ocean2'}">
                                        <img src="https://forge.laravel.com/images/icons/digital-ocean.svg">
                                        <div class="text-center">
                                            DigitalOcean
                                        </div>
                                    </a>
                                </div>

                                <div class="col">
                                    <a v-on:click.prevent="currentTab = 'linode4'" href="#" class="d-flex flex-column justify-content-between providerOption" :class="{'active': currentTab == 'linode4'}">
                                        <img src="https://forge.laravel.com/images/icons/linode.svg">
                                        <div class="text-center">
                                            Linode Cloud
                                        </div>
                                    </a>
                                </div>

                                <div class="col">
                                    <a v-on:click.prevent="currentTab = 'aws'" href="#" class="d-flex flex-column justify-content-between providerOption" :class="{'active': currentTab == 'aws'}">
                                        <img src="https://forge.laravel.com/images/icons/aws.svg">
                                        <div class="text-center">
                                            AWS
                                        </div>
                                    </a>
                                </div>

                                <div class="col">
                                    <a v-on:click.prevent="currentTab = 'vultr'" href="#" class="d-flex flex-column justify-content-between providerOption" :class="{'active': currentTab == 'vultr'}">
                                        <img src="https://forge.laravel.com/images/icons/vultr.svg">
                                        <div class="text-center">
                                            Vultr
                                        </div>
                                    </a>
                                </div>

                                <div class="col">
                                    <a v-on:click.prevent="currentTab = 'hetzner'" href="#" class="d-flex flex-column justify-content-between providerOption" :class="{'active': currentTab == 'hetzner'}">
                                        <img src="https://forge.laravel.com/images/icons/hetzner.svg" class="w-100">
                                        <div class="text-center">
                                            Hetzner
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="mt-4">
                                <!-- DigitalOcean Tab -->
                                <div v-if="currentTab == 'ocean2'">
                                    
                                                                            <div class="alert alert-info">
                                            You can create a new DigitalOcean API access token for yourself or your team from the
                                            <a href="https://cloud.digitalocean.com/settings/api/tokens" target="_blank">DigitalOcean API settings panel</a>.
                                        </div>

                                        <form ref="form-connect-ocean2" role="form" method="POST" action="https://forge.laravel.com/user/credentials/ocean2">
                                            <input type="hidden" name="_token" value="sWLc8YZbpIlhzowG8gjmnvx9nYL1M0KIhEZKktMq">

                                            <div class="form-group row">
                                                <label for="ocean_token" class="col-md-3 col-form-label text-md-right">API Token</label>
                                                <div class="col-md-7">
                                                    <input type="password" name="ocean_token" class="form-control" placeholder="API Key">
                                                </div>
                                            </div>
                                        </form>
                                                                    </div>

                                <!-- Linode Tab -->
                                <div v-if="currentTab == 'linode4'">
                                    
                                                                            <div class="alert alert-info">
                                            You can create a new Linode API key for yourself or your team from the
                                            <a href="https://cloud.linode.com/profile/tokens" target="_blank">Linode API Tokens panel</a>.
                                        </div>

                                        <form ref="form-connect-linode4" role="form" method="POST" action="https://forge.laravel.com/user/credentials/linode4">
                                            <input type="hidden" name="_token" value="sWLc8YZbpIlhzowG8gjmnvx9nYL1M0KIhEZKktMq">

                                            <div class="form-group row">
                                                <label for="linode_api_key" class="col-md-3 col-form-label text-md-right">Linode API Key</label>
                                                <div class="col-md-7">
                                                    <input type="password" name="linode_api_key" class="form-control" placeholder="API Key">
                                                </div>
                                            </div>
                                        </form>
                                                                    </div>

                                <!-- Amazon Tab -->
                                <div v-if="currentTab == 'aws'">
                                    
                                                                            <div class="alert alert-info">
                                            You can create a new AWS API access key and secret for yourself or your team from the
                                            <a href="https://console.aws.amazon.com/iam/home" target="_blank">AWS IAM dashboard</a>.
                                        </div>

                                        <form ref="form-connect-aws" role="form" method="POST" action="https://forge.laravel.com/user/credentials/aws">
                                            <input type="hidden" name="_token" value="sWLc8YZbpIlhzowG8gjmnvx9nYL1M0KIhEZKktMq">

                                            <div class="form-group row">
                                                <label for="aws_key" class="col-md-3 col-form-label text-md-right">AWS Key</label>
                                                <div class="col-md-7">
                                                    <input type="text" name="aws_key" class="form-control" placeholder="Key">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="aws_secret" class="col-md-3 col-form-label text-md-right">AWS Secret</label>
                                                <div class="col-md-7">
                                                    <input type="password" name="aws_secret" class="form-control" placeholder="Secret">
                                                </div>
                                            </div>
                                        </form>
                                                                    </div>

                                <!-- Vultr Tab -->
                                <div v-if="currentTab == 'vultr'">
                                    
                                                                            <div class="alert alert-info">
                                            You can create a new Vultr API key for yourself or your team from the
                                            <a href="https://my.vultr.com/settings/#settingsapi" target="_blank">Vultr API page</a>.
                                        </div>

                                        <form ref="form-connect-vultr" role="form" method="POST" action="https://forge.laravel.com/user/credentials/vultr">
                                            <input type="hidden" name="_token" value="sWLc8YZbpIlhzowG8gjmnvx9nYL1M0KIhEZKktMq">

                                            <div class="form-group row">
                                                <label for="linode_api_key" class="col-md-3 col-form-label text-md-right">API Key</label>
                                                <div class="col-md-7">
                                                    <input type="password" name="vultr_api_key" class="form-control" placeholder="API Key">
                                                </div>
                                            </div>
                                        </form>
                                                                    </div>

                                <!-- Hetzner Tab -->
                                <div v-if="currentTab == 'hetzner'">
                                    
                                                                            <div class="alert alert-info">
                                            You can create a new Hetzner API key for yourself or your team from the
                                            <a href="https://console.hetzner.cloud/projects" target="_blank">Hetzner Cloud Console</a>.
                                        </div>

                                        <form ref="form-connect-hetzner" role="form" method="POST" action="https://forge.laravel.com/user/credentials/hetzner">
                                            <input type="hidden" name="_token" value="sWLc8YZbpIlhzowG8gjmnvx9nYL1M0KIhEZKktMq">

                                            <div class="form-group row">
                                                <label for="linode_api_key" class="col-md-3 col-form-label text-md-right">API Key</label>
                                                <div class="col-md-7">
                                                    <input type="password" name="hetzner_api_key" class="form-control" placeholder="API Key">
                                                </div>
                                            </div>
                                        </form>
                                                                    </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row mb-0 justify-content-end">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-green" v-on:click="submit()">Connect</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </connect>
        </div>

        <div style="margin-top: 10px">
            &nbsp;
        </div>
    </div> <!-- End App Controller -->
</div>

<script src="/js/app.js?id=b35ce52ecc06923af209"></script>

    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-23865777-2', 'laravel.com');
        ga('send', 'pageview');

    </script>

    <script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
    <script type="text/javascript">window.Beacon('init', 'ed257e28-582a-4a65-9cf6-2e405771bfd6')</script>

            <script>
            Beacon('config', {
              messaging: {
                showPrefilledCustomFields: false,
              }
            });

            Beacon('identify', {
                id: 146777,
                avatar: 'https://unavatar.now.sh/paulosergiobp%40gmail.com?fallback=https%3A%2F%2Fui-avatars.com%2Fapi%3Fname%3Dpaulosergiobp%26color%3D7F9CF4%26background%3DEBF4FF',
                name: 'paulosergiobp',
                email: 'paulosergiobp@gmail.com',
                'stripeId': '',
                'profile': 'https://forge.laravel.com/nova/resources/users/146777',
                'impersonate': 'https://forge.laravel.com/nova-impersonate/users/146777',
                
            });

            Beacon('prefill', {
                fields: [
                    {
                        id: 24384,
                        value: 120342
                    },
                ]
            });
        </script>
    

</body>
</html>
