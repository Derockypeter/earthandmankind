<template>
    <div>
        <ul class="pagination center">
            <li v-bind:class="[{disabled: !meta_data.prev_url === null}]">
                <a href=""  @click="next(meta_data.current_page-1)"><i class="material-icons">chevron_left</i></a>
            </li>
            <li v-for="page in meta_data.last_page" 
                :key="page" 
                :class="{ 'active':meta_data.current_page === page }">
                <a href="#" 
                    @click.prevent="next(page)" 
                    class="page-link">
                    {{ page }}
            </li>
            <li :class="{ 'disabled': meta_data.current_page === meta_data.last_page }">
                <a  href="#" class="page-link" @click="next(meta_data.current_page+1)"><i class="material-icons">chevron_right</i></a>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: ['meta_data'],
    methods: {
        next(page) {
            this.$emit('next', page);
        }
    }
}
</script>