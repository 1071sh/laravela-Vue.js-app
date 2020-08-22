<template>
    <div>
        <form
            method="POST"
            enctype="multipart/form-data"
            @submit.prevent="submitDomain"
        >
            <div class="form-group">
                <label for="category">Select a category</label>
                <select
                    id="category"
                    class="form-control"
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
                    id="subcategory"
                    class="form-control"
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
                        placeholder="Please enter your email Address"
                        v-model="form.email"
                        @keydown="form.errors.clear('email')"
                    />
                    <div
                        class="invalid-feedback"
                        v-show="form.errors.has('email')"
                        v-text="form.errors.get('email')"
                    ></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="url">Enter your Domain URL</label>
                    <input
                        type="text"
                        :class="{ 'is-invalid': form.errors.has('url') }"
                        class="form-control"
                        placeholder="http://your-domain.com"
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
                <input type="file" id="img" class="form-control-file" />
            </div>
            <div class="form-group">
                <label for="title">Title of your Domain</label>
                <input
                    type="text"
                    :class="{ 'is-invalid': form.errors.has('title') }"
                    class="form-control"
                    v-model="form.title"
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
                    :class="{ 'is-invalid': form.errors.has('shortdesc') }"
                    class="form-control"
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

            <button type="submit" class="btn btn-success">
                Submit your Domains
            </button>
        </form>
    </div>
</template>

<script>
export default {
    props: ["categories", "subcategories"],
    data() {
        return {
            form: new Form({
                email: "",
                title: "",
                url: "",
                shortdesc: "",
                desc: "",
                category_id: "1",
                subcategory_id: ""
            })
        };
    },
    methods: {
        submitDomain() {
            let data = new FormData();
            data.append("title", this.form.title);
            data.append("email", this.form.email);
            data.append("url", this.form.url);
            data.append("shortdesc", this.form.shortdesc);
            data.append("desc", this.form.desc);
            data.append("category_id", this.form.category_id);
            data.append("subcategory_id", this.form.subcategory_id);
            if (document.getElementById("img").files[0]) {
                data.append("img", document.getElementById("img").files[0]);
            }
            axios
                .post("/domain", data)
                .then(response => {
                    this.form.reset();
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
