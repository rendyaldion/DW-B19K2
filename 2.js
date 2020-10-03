const betweenDays = (start, end) => {
    const startDate = new Date(start);
    const endDate = new Date(end);
    let i = 1;
    let run = true;

    console.log(startDate);

    while (run) {
        let nextDay = new Date(startDate);
        nextDay.setDate(startDate.getDate() + i);

        if (nextDay != endDate) {
            console.log(nextDay);
            i++;
        } else {
            run = false;
        }
    }

    console.log(endDate);
}

betweenDays('2019-11-01', '2019-11-05');