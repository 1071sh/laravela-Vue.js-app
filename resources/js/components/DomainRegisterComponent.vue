<template>
    <div>
        <form action="">
            <div class="form-group">
                <label for="category">Select a category</label>
                <select name="" id="category" class="form-control"></select>
            </div>
            <div class="form-group">
                <label for="subcategory"
                    >Select a subcategory if you wish</label
                >
                <select name="" id="subcategory" class="form-control"></select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        placeholder="Please enter your email Address"
                    />
                </div>
                <div class="form-group col-md-6">
                    <label for="url">Enter your Domain URL</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="http://your-domain.com"
                    />
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="file" id="img" class="form-control-file" />
            </div>
            <div class="form-group">
                <label for="title">Title of your Domain</label>
                <input type="text" class="form-control" />
            </div>
            <div class="form-group">
                <label for="shortdesc">short description</label>
                <input type="text" class="form-control" />
            </div>
            <div class="form-group">
                <vue-editor />
            </div>

            <button type="submit" class="btn btn-success">
                Submit your Domains
            </button>
        </form>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
