{{ HTML::style('admin/css/table.css') }}
<table>
    <thead>
    <tr>
        <th>THỨ TỰ</th>
        <th>TIÊU ĐỀ TIN</th>
        <th>TÓM LƯỢC TIN</th>
        <th>NGÀY GIỜ</th>      
        <th>NGUỒN LẤY</th>
    </tr>
    </thead>
    <tbody>
        @foreach($contents as $key => $content)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td width="{{ $settings['widthTitle'] }}">{{ $content->title }}</td>
            <td width="{{ $settings['widthDescription'] }}">{{ $content->description }}</td>
            <td>{{ $content->pubDate }}</td>
            <td>{{ $content->sourceOfNews }}</td>
        </tr>
        @endforeach
    </tbody>
</table>