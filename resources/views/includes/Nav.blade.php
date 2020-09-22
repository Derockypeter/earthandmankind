<header>
    <nav style="background-color: #424242;">
        <div class="container">
            <div class="nav-wrapper">
                <a href="/" class="brand-logo logo-pr-6">EARTHANDMANKIND</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down pr-6">
                    <li><a href="/">HOME</a></li>
                    <li><a href="/library">LIBRARY</a></li>
                    <li><a href="/article">ARTICLES</a></li>
                    <li><a href="/dictionary">DICTIONARY</a></li>
                    <li><a href="/contact">CONTACT</a></li>
                    
                    {{-- Removing this for the mean time --}}
                    {{-- <li class="green-text"><a href="/login'"><em>LOGIN</em></a></li> --}}
                    
                    {{-- <li v-if="isLoggedIn">
                        <router-link :to="{ name: 'dashboard' }" v-if="user_type == 0" class='dropdown-trigger btn' href='#' data-target='dropdown2'> Hi, @{{firstname}}</router-link>
                        <router-link :to="{ name: 'admin' }" v-if="user_type == 1" class='dropdown-trigger btn' href='#' data-target='dropdown2'> Hi, @{{firstname}}</router-link>
                    </li> --}}
                </ul>
                {{-- <ul id='dropdown2' class='dropdown-content'>
                    <li><a href="#" @click="logOut">LOGOUT</a></li>
                </ul> --}}
            </div>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="/">HOME</a></li>
        <li><a href="/library">LIBRARY</a></li>
        <li><a href="/article">ARTICLES</a></li>
        <li><a href="/dictionary">DICTIONARY</a></li>
        <li><a href="/contact">CONTACT</a></li>

        {{-- <li v-if='!isLoggedIn' class="green-text"><li class="green-text"><a href="/login"><em>LOGIN</em></a></li> --}}
        
        {{-- <li v-if="isLoggedIn">
            <router-link :to="{ name: 'dashboard' }" v-if="user_type == 0" class='dropdown-trigger btn' href='#' data-target='dropdown1'> Hi, @{{firstname}}</router-link>
            <router-link :to="{ name: 'admin' }" v-if="user_type == 1"> Hi, @{{firstname}}</router-link>
        </li> --}}
    </ul>
    {{-- <ul id='dropdown1' class='dropdown-content'>
        <li><a href="#" v-if="isLoggedIn" @click="logOut">LOGOUT</a></li>
    </ul> --}}
</header>