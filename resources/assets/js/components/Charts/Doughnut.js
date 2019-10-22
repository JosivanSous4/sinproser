import { Doughnut } from 'vue-chartjs';
import { reactiveProp } from 'vue-chartjs/src/mixins';

export default {
    props: ['chartData','options'],
    mixins: [reactiveProp],
    extends: Doughnut,
    mounted () {
        this.renderChart(this.chartData, this.options);
    }
}