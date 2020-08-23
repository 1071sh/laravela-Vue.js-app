<template>
    <div>
        <form
            @submit.prevent="submitDomain"
            method="POST"
            enctype="multipart/form-data"
        >
            <div class="form-group">
                <label for="category">Select a category</label>
                <select
                    class="form-control"
                    id="category"
                    v-model="form.category_id"
                >
                    <option
                        v-for="(category, key) in this.categories"
                        :value="category.id"
                        :key="key"
                        >{{ category.categoryname }}</option
                    >
                </select>
            </div>
            <div class="form-group">
                <label for="subcategory"
                    >Select a subcategory if you wish</label
                >
                <select
                    class="form-control"
                    id="subcategory"
                    v-model="form.subcategory_id"
                >
                    <option
                        v-for="(subcategory, key) in filteredSubcategores"
                        :value="subcategory.id"
                        :key="key"
                        >{{ subcategory.subcategoryname }}</option
                    >
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                        class="form-control"
                        id="email"
                        v-model="form.email"
                        placeholder="Your email address"
                        @keydown="form.errors.clear('email')"
                    />
                    <div
                        class="invalid-feedback"
                        v-show="form.errors.has('email')"
                        v-text="form.errors.get('email')"
                    ></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="url"
                        >Domain URL
                        <span class="text-secondary"
                            >Start with: http:// or https://</span
                        ></label
                    >
                    <input
                        type="text"
                        :class="{ 'is-invalid': form.errors.has('url') }"
                        class="form-control"
                        id="url"
                        placeholder="https://www.your-doamin.com"
                        v-model="form.url"
                        @keydown="form.errors.clear('url')"
                    />
                    <div
                        class="invalid-feedback"
                        v-show="form.errors.has('url')"
                        v-text="form.errors.get('url')"
                    ></div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input id="img" type="file" class="form-control-file" />
                <p
                    class="text-danger text-sm"
                    v-show="form.errors.has('img')"
                    v-text="form.errors.get('img')"
                ></p>
            </div>
            <div class="form-group">
                <label for="title">Title of your website</label>
                <input
                    type="text"
                    :class="{ 'is-invalid': form.errors.has('title') }"
                    class="form-control"
                    id="title"
                    v-model="form.title"
                    placeholder="Money blokes"
                    @keydown="form.errors.clear('title')"
                />
                <div
                    class="invalid-feedback"
                    v-show="form.errors.has('title')"
                    v-text="form.errors.get('title')"
                ></div>
            </div>
            <div class="form-group">
                <label for="shortdesc">short description</label>
                <input
                    type="text"
                    :class="{
                        'is-invalid': form.errors.has('shortdesc')
                    }"
                    class="form-control"
                    id="shortdesc"
                    placeholder="This website is about money management..."
                    v-model="form.shortdesc"
                    @keydown="form.errors.clear('shortdesc')"
                />
                <div
                    class="invalid-feedback"
                    v-show="form.errors.has('shortdesc')"
                    v-text="form.errors.get('shortdesc')"
                ></div>
            </div>
            <div class="form-group">
                <vue-editor v-model="form.desc" />
            </div>

            <!-- <button type="submit" class="btn btn-success">
                Submit your Domains
            </button> -->
            <div
                class="mx-auto w-50"
                ref="paypal"
                id="paypal-button-container"
            ></div>
        </form>
    </div>
</template>

<script>
export default {
    props: ["categories", "subcategories"],
    data() {
        return {
            product: {
                description: "Payment for Backlink app",
                price: 9.99
            },
            form: new Form({
                email: "",
                title: "",
                url: "",
                shortdesc: "",
                desc: "",
                paidFor: true,
                category_id: "1",
                subcategory_id: ""
            })
        };
    },
    mounted: function() {
        const script = document.createElement("script");
        script.src =
            "https://www.paypal.com/sdk/js?client-id=ARvAIyRJnLvDAw8zJ1k6O85uBWdOQEvpErFXUnR1-5P4ahdjPtY5o19ET5CjGwctAHGerUeGKmtza7s7";
        script.addEventListener("load", this.setLoaded);
        document.body.appendChild(script);
    },
    methods: {
        setLoaded: function() {
            window.paypal
                .Buttons({
                    createOrder: (data, actions) => {
                        return actions.order.create({
                            purchase_units: [
                                {
                                    description: this.product.description,
                                    amount: {
                                        currency_code: "USD",
                                        value: this.product.price
                                    }
                                }
                            ]
                        });
                    },
                    onApprove: async (data, actions, resp) => {
                        const order = await actions.order.capture();
                        this.data;
                        this.submitDomain();
                    },
                    onError: err => {
                        console.log(err);
                    }
                })
                .render(this.$refs.paypal);
        },
        submitDomain() {
            let data = new FormData();
            data.append("title", this.form.title);

            data.append("url", this.form.url);
            data.append("email", this.form.email);
            data.append("shortdesc", this.form.shortdesc);
            data.append("desc", this.form.desc);
            data.append("paid", this.form.paidFor);
            data.append("category_id", this.form.category_id);
            data.append("subcategory_id", this.form.subcategory_id);
            if (document.getElementById("img").files[0]) {
                data.append("img", document.getElementById("img").files[0]);
            }
            axios
                .post("/domain", data)
                .then(response => {
                    this.form.reset();
                    window.location.href = "../";
                })
                .catch(error => this.form.errors.record(error.response.data));
        }
    },
    computed: {
        filteredSubcategores: function() {
            return this.subcategories.filter(
                item => item.category_id == this.form.category_id
            );
        }
    }
};
</script>

<style></style>
