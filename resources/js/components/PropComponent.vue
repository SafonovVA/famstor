<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="tabel">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Url</th>
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
        props: ['urldata'],
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                console.log(this.urldata);
            }
        }
    }
</script>
