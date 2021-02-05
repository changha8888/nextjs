import { Table, Tag } from "antd";
import { Button } from 'antd';
import { Image } from 'antd';

const PostTable = ({dataSource}) => {
    const columns = [
        {
            title: 'Title',
            dataIndex: 'title',
            key: 'title',
        },
        {
            title: 'Image',
            dataIndex: 'image',
            key: 'image',
            render:  (image) => <Image  width={200} src={image} />
        },
        {
            title: 'Status',
            dataIndex: 'status',
            key: 'status',

            render: status => (
                <>
                    <Tag color="green" key={status}>
                        {status}
                    </Tag>
                    <Button type="success" shape="round" size="medium">
                        Show
                    </Button>
                </>
            ),
        },
    ];

    return <Table dataSource={dataSource} columns={columns} />;
}

export default PostTable;