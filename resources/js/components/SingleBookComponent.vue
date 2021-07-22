<template>
    <div class="container articles">
        <div class="main-container">
            <div class="center" v-if="!loaded" style="height:500px">
                <div style="top:250px" class="preloader-wrapper small active">
                    <div class="spinner-layer spinner-red-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row dictHeader" v-else>
                <div class="col s12">
                    <h1 class="fSize">{{ book.name }}</h1>
                    <div class="col s12 l6">
                        <img
                            :src="'/books/images/' + book.image"
                            alt=""
                            srcset=""
                            class="responsive-img"
                            height="50px"
                        />
                        
                    </div>
                    <div class="col s12 l6">
                        <p>{{ book.description }}</p>
                        <span class="buttonPayment">
                            <a
                                v-if="!payed"
                                class="btn waves waves effect black btn-small modal-trigger"
                                href="#openForm"
                            >
                                Get for &#36;{{ book.amount }}
                            </a>
                            <a
                                v-else
                                class="btn btn-small downloadBook waves waves-effect grey darken-4"
                                @click.prevent="download(book.id)"
                                :disabled="downloading"
                                >{{
                                    downloading ? "Downloading..." : "Download"
                                }}</a
                            >

                            <a
                                class="preloader-wrapper active"
                                v-if="verifypayment"
                            >
                                <div class="spinner-layer spinner-red-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </a>
                        </span>
                        <h6>You get a copy of the book plus an audio book.</h6>
                        <p v-if="payed">
                            Your book is ready to download. Thanks for purchasing
                        </p>
                    </div>
                    
                </div>
                <!-- <div class="col s12 l4 middle">
                    <div>
                        <h6>Related books</h6>
                    </div>
                </div> -->
            </div>

            <!-- Modal Structure -->
            <div id="openForm" class="modal">
                <i class="material-icons right modal-close">close</i>
                <div class="modal-content">
                    <h4>Enter Details</h4>
                    <div class="row">
                        <form class="col s12">
                            <div class="row">
                                <div class="input-field col s12 l6">
                                    <input
                                        id="name"
                                        type="text"
                                        class="validate"
                                        v-model="form.name"
                                    />
                                    <label for="first_name">Names</label>
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        id="email"
                                        type="email"
                                        v-model="form.email"
                                        class="validate"
                                    />
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <h6>
                                <em>
                                    Please close this form after successful
                                    payment. Thank You</em
                                >
                            </h6>
                        </form>

                        <a
                            class="btn waves waves effect green lighten-2"
                            @click="makePayment"
                            >Make payment</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.articles {
    margin-top: 2vh;
    box-shadow: 13px 13px 20px grey;
    height: 100%;
}
.middle {
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.chip:hover {
    cursor: pointer;
}
.dictHeader h1 {
    margin-top: 0px;
}
.fSize {
    font-size: 1.5em;
}
</style>
<script>
const flwKey = "FLWPUBK-e30d071e2637b534cd80d4309fa97362-X";
export default {
    data() {
        return {
            book: [],
            downloading: false,
            loaded: false,
            payed: false,
            verifypayment: false,
            form: {
                name: "",
                email: ""
            },
            flwKey: flwKey,
            currency: "USD",
            country: "NG",
            paymentMethod: ""
        };
    },
    computed: {
        reference() {
            let text = "";
            let possible =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (let i = 0; i < 10; i++)
                text += possible.charAt(
                    Math.floor(Math.random() * possible.length)
                );
            return text;
        }
    },
    mounted() {
        let book_uri = `/api/books/${this.$route.params.bookname}`;
        this.axios
            .get(book_uri)
            .then(response => {
                setTimeout(() => {
                    this.loaded = true;
                    this.book = response.data;
                    this.form.amount = this.book.amount;
                }, 1000);
            })
            .catch(err => {
                console.log(err);
            });
    },
    created() {
        const script = document.createElement("script");
        script.src = "https://checkout.flutterwave.com/v3.js";
        document.getElementsByTagName("head")[0].appendChild(script);
        if (window.location.search) {
            this.axios
                .post("/api/bookrequest", window.location.search)
                .then(response => {
                    if (!response.data.data) {
                        return "";
                    } else if (response.data.data.status == "successful") {
                        this.payed = true;
                    }
                })
                .catch(err => console.log(err));
        }
    },
    methods: {
        makePayment() {
            window.FlutterwaveCheckout({
                public_key: this.flwKey,
                tx_ref: this.reference,
                amount: this.book.amount,
                currency: this.currency,
                payment_options: this.payment_method,
                customer: {
                    name: this.form.name,
                    email: this.form.email
                },
                redirect_url: `${this.book.name}`,
                callback(data) {
                    console.log(data);
                },
                onclose: function() {
                    console.log("closed checkout page");
                },
                customizations: {
                    title: "Earthandmankind",
                    description: "Payment for book purchase"
                    // logo:
                }
            });
        },
        download(id) {
            this.downloading = true;
            this.axios({
                url: `/api/downloadbook/${id}`,
                method: "GET",
                responseType: "blob" // important
            }).then(response => {
                const url = window.URL.createObjectURL(
                    new Blob([response.data])
                );
                const link = document.createElement("a");
                link.href = url;
                link.setAttribute("download", `${this.book.name}.zip`);
                document.body.appendChild(link);
                link.click();
                setTimeout(() => {
                    this.downloading = false;
                }, 3000);
            });
        }
    }
};
</script>
