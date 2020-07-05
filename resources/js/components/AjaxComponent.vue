<template>
    <div class="container">
        <div class="row">
            <div class="table">
                <button @click="update" class="btn btn-default text mb-1" v-show="!is_refresh">Update - {{ id }}</button>
                <span class="badge badge-primary mb-1" v-show="is_refresh">In process</span>
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Url</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="url in urldata"
                        :key="url.url">
                            <td>{{ url.title }}</td>
                            <td>{{ url.url }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            urldata: [],
            is_refresh: false,
            id: 0,
        }
    },
    mounted: function() {
        this.update();
    },
    methods: {
        update: function () {
            console.log(1);
            this.is_refresh = false;
            axios.get('/home/get-json').then((response) => {
                console.log(response);
                this.is_refresh = false;
                this.id++;
                this.urldata = response.data;
            });
        },
    }
}
</script>
