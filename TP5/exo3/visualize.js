const url = 'https://disease.sh/v3/covid-19/historical/all?lastdays=all';

d3.json(url).then(function(data) {
    const timeline = data.cases;

    const covidData = Object.keys(timeline).map(date => ({
        date: new Date(date),
        cases: timeline[date]
    }));

    drawChart(covidData);
}).catch(function(error) {
    console.error('Error fetching data:', error);
});

function drawChart(data) {
    const width = 900;
    const height = 500;
    const margin = { top: 20, right: 30, bottom: 50, left: 50 };

    const svg = d3.select('#chart')
        .append('svg')
        .attr('width', width + margin.left + margin.right)
        .attr('height', height + margin.top + margin.bottom)
        .append('g')
        .attr('transform', `translate(${margin.left}, ${margin.top})`);

    const x = d3.scaleTime()
        .domain(d3.extent(data, d => d.date))
        .range([0, width]);

    const y = d3.scaleLinear()
        .domain([0, d3.max(data, d => d.cases)])
        .nice()
        .range([height, 0]);

    // Add X axis
    svg.append('g')
        .attr('transform', `translate(0,${height})`)
        .call(d3.axisBottom(x))
        .selectAll('text')
        .attr('transform', 'rotate(-45)')
        .style('text-anchor', 'end');

    // Add Y axis
    svg.append('g')
        .call(d3.axisLeft(y));

    // Add gridlines
    svg.append('g')
        .attr('class', 'grid')
        .call(d3.axisLeft(y)
            .tickSize(-width)
            .tickFormat(''));

    // Define the line (orange color)
    const line = d3.line()
        .x(d => x(d.date))
        .y(d => y(d.cases))
        .curve(d3.curveMonotoneX);  // Smooth line

    // Draw the line with animation
    const path = svg.append('path')
        .datum(data)
        .attr('class', 'line')
        .attr('d', line)
        .attr('stroke', 'orange')  // Change to orange color
        .attr('stroke-width', 3)
        .attr('fill', 'none')
        .attr('stroke-dasharray', function() { return this.getTotalLength(); })
        .attr('stroke-dashoffset', function() { return this.getTotalLength(); })
        .transition()
        .duration(2000)
        .attr('stroke-dashoffset', 0);

    // Tooltip (without dots)
    const tooltip = d3.select('body').append('div')
        .attr('class', 'tooltip')
        .style('opacity', 0);

    svg.append('rect')
        .attr('width', width)
        .attr('height', height)
        .attr('fill', 'none')
        .attr('pointer-events', 'all')
        .on('mousemove', function(event) {
            const mouse = d3.pointer(event);
            const xDate = x.invert(mouse[0]);
            const bisect = d3.bisector(d => d.date).left;
            const idx = bisect(data, xDate);
            const d = data[idx];
            tooltip.transition()
                .duration(200)
                .style('opacity', .9);
            tooltip.html(`Date: ${d.date.toLocaleDateString()}<br>Cases: ${d.cases}`)
                .style('left', (event.pageX + 10) + 'px')
                .style('top', (event.pageY - 28) + 'px');
        })
        .on('mouseout', function() {
            tooltip.transition()
                .duration(500)
                .style('opacity', 0);
        });

    // Add X axis label
    svg.append('text')
        .attr('class', 'axis-label')
        .attr('x', width / 2)
        .attr('y', height + margin.bottom - 10)
        .style('text-anchor', 'middle')
        .text('Date');

    // Add Y axis label
    svg.append('text')
        .attr('class', 'axis-label')
        .attr('x', -height / 2)
        .attr('y', -margin.left + 15)
        .attr('transform', 'rotate(-90)')
        .style('text-anchor', 'middle')
        .text('Daily Cases');
}


