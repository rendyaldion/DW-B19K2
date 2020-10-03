const cetak_gambar = (num) => {
    for (let i = 1; i <= num; i++) {
        let row = [];
        
        for (let x = 1; x <= num - 2; x++) {
            if (i % 2 == 0) {
                if ((x + 1) % 2 == 0)
                    row.push('=');
                else
                    row.push('*');
            } else {
                if ((x + 1) % 2 == 1)
                    row.push('=');
                else
                    row.push('*');
            }    
        }

        console.log('*' + row.join('') + '*');
    }
}

cetak_gambar(5);