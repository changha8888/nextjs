import Head from 'next/head'
import axios from 'axios'
import { useEffect, useState } from 'react'
import Sidebar from '../components/shared/Sidebar'
import Table from '../components/Post/Table'

import { Layout, Menu, Breadcrumb, Pagination } from 'antd';
import AddNew from "../components/Post/AddNew";


export default function Home() {

  const [tasks, setTasks] = useState([]);

  const [query, setQuery] = useState();

  useEffect(() => {
    const data = axios.get(`http://api.blog.local/api/posts${query ? query : ''}`).then(res => {
      console.log(res.data.data)
      setTasks(res.data.data);
      console.log(tasks)
    });
  }, [query]);

  return (
        <Layout>
          <Sidebar />
          <Layout style={{ padding: '0 24px 24px' }}>
            <Breadcrumb style={{ margin: '16px 0' }}>
              <Breadcrumb.Item>Home</Breadcrumb.Item>
              <Breadcrumb.Item>App</Breadcrumb.Item>
              <AddNew />
            </Breadcrumb>
            <Table dataSource={tasks} pagination={ {disabled:true} }></Table>
          </Layout>
        </Layout>
  )
}