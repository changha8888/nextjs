import { Button } from 'antd';
import { FileAddOutlined } from '@ant-design/icons';
import Link from 'next/link'

export default function AddNew({}) {
    return (
        <>
            <Link href={`/posts/add`}>
            <Button type="primary" style={{float: 'right'}} shape="round" icon={<FileAddOutlined />}>Add NEW</Button>
            </Link>
        </>
    )
}