function create_download_ics(subject, description, location, begin, end) {
    var parsed_begin_date = new Date(begin);
    var parsed_end_date = new Date();
    parsed_end_date.setDate(parsed_begin_date.getDate() + 1);
    parsed_begin_date.setHours(21);
    parsed_end_date.setHours(1) 
    console.log(parsed_begin_date.toISOString());
    console.log(parsed_end_date.toISOString());


    var cal = ics();
    cal.addEvent(subject, description, location, parsed_begin_date, parsed_end_date);
    var fileName = subject+begin;
    cal.download(fileName);
}
