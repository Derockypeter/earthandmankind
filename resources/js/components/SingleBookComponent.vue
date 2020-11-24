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
                <div class="col s12 l8">
                    <h1>{{ book.name }}</h1>
                </div>
                <div class="col s12">
                    <img
                        :src="'/books/images/' + book.image"
                        alt=""
                        srcset=""
                        height="300"
                    />
                    <p></p>
                    <p>{{ book.description }}</p>
                    <p v-if="payed">
                        Your book is ready to download. Thanks for purchasing
                    </p>

                    <p>
                        <a
                            v-if="!payed"
                            class="btn waves waves effect black btn-small modal-trigger"
                            href="#openForm"
                        >
                            Buy Now
                        </a>
                        <a v-else
                            class="btn btn-small downloadBook waves waves-effect grey darken-4"
                            @click.prevent="download(book.id)"
                            :disabled="downloading"
                            >{{ downloading ? 'Downloading...' : 'Download' }}</a
                        >
                        
                        <!-- <a
                        :href="'path/' + book.path"
                            :download="book.name"
                            v-if="!payed"
                            class="btn btn-small downloadBook waves waves-effect grey darken-4"
                            :href="'preview/' + book.preview"
                            >Preview</a
                        > -->

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
                    </p>
                </div>
            </div>

            <!-- Modal Structure -->
            <div id="openForm" class="modal">
                <i class="material-icons right modal-close">close</i>
                <div class="modal-content">
                    <h4>Enter Details</h4>
                    <div class="row">
                        <form class="col s12">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input
                                        id="name"
                                        type="text"
                                        class="validate"
                                        v-model="form.names"
                                    />
                                    <label for="first_name">Names</label>
                                </div>
                                <div class="input-field col s6">
                                    <input
                                        id="email"
                                        type="email"
                                        v-model="form.email"
                                        class="validate"
                                    />
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <input type="hidden" v-model="form.amount" />
                            <input
                                type="hidden"
                                v-model="form.currency"
                                value="NGN"
                            />
                            <input
                                type="hidden"
                                name="reference"
                                v-model="form.reference"
                            />
                            <h6>
                                <em>
                                    Please close this form after successful
                                    payment. Thank You</em
                                >
                            </h6>
                        </form>
                        <paystack
                            class="btn waves waves effect green lighten-2"
                            :amount="form.amount * 100"
                            :email="form.email"
                            :paystackkey="form.paystackkey"
                            :reference="reference"
                            :callback="processPayment"
                            :close="close"
                        >
                            Make Payment
                        </paystack>
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
}
/* .nav-wrapper{
        width: 500px;
        float: right;
        border: thin solid;
        border-radius: 20px;
    } */
.chip:hover {
    cursor: pointer;
}
.dictHeader h1 {
    margin-top: 0px;
}
</style>
<script>
import paystack from "vue-paystack";

export default {
    data() {
        return {
            book: [],
            downloading: false,
            loaded: false,
            payed: false,
            verifypayment: false,
            form: {
                names: "",
                email: "",
                amount: "",
                currency: "NGN",
                paystackkey: "pk_test_84576da9ef7d7315cc8269cadd09c39ce01608f7" //paystack public key
            }
        };
    },
    components: {
        paystack
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
    methods: {
        processPayment(response) {
            this.verifypayment = true;
            document.addEventListener("DOMContentLoaded", function() {
                var elems = document.querySelectorAll(".modal");
                var instances = M.Modal.init(elems, options);
                instances.close();
            });
            fetch("/api/bookrequest", {
                method: "post",
                body: JSON.stringify(response),
                headers: {
                    "Content-Type": "application/json;charset=utf-8"
                }
            })
                .then(res => res.json())
                .then(json => {
                    // console.log(json)
                    if (json.data.status == "success") {
                        this.verifypayment = false;
                        this.payed = true;
                    }
                })
                .catch(err => console.log(err));
        },
        close: () => {
            console.log("You closed checkout page");
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
                link.setAttribute("download", `${this.book.name}.pdf`);
                document.body.appendChild(link);
                link.click();
                setTimeout(() => {
                    this.downloading = false;
                }, 3000)
            });
            
        }
    }
};
</script>
