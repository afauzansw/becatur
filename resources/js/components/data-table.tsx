import { Base } from "@/types/base";
import { useEffect, useState } from "react";
import { Button, Input, Table } from "./ui";
import { IconArrowUp, IconChevronLeft, IconChevronRight, IconLoader2, IconSortAsc } from "justd-icons";

export interface Column<T> {
    id: string;
    header: string;
    cell: (item: T) => React.ReactNode;
    sortable?: boolean;
    isRowHeader?: boolean;
}

interface DataTableProps<T> {
    columns: Column<T>[];
    fetchData: (params: Record<string, any>) => Promise<Base<T[]>>;
    filters: Record<string, any>;  // External filters passed from parent
    onSort?: (field: string, direction: 'asc' | 'desc' | null) => void;  // Optional sort handler
    onSuccess?: (data: Base<T[]>) => void;
    onError?: (error: any) => void;
}

export const DataTable = <T extends Record<string, any>>({
    columns,
    fetchData,
    filters,
    onSort,
    onSuccess,
    onError,
}: DataTableProps<T>) => {
    const [data, setData] = useState<Base<T[]>>({ items: [] });
    const [loading, setLoading] = useState(false);
    const [sort, setSort] = useState<{ field: string; direction: 'asc' | 'desc' } | null>(null);
    const [currentPage, setCurrentPage] = useState(1);

    const loadData = async () => {
        setLoading(true);
        try {
            const params: Record<string, any> = {
                page: currentPage,
                ...(filters && typeof filters === 'object'
                    ? Object.entries(filters).reduce((acc, [key, value]) => {
                        if (value !== undefined && value !== '') {
                            acc[`filter[${key}]`] = value;
                        }
                        return acc;
                    }, {} as Record<string, any>)
                    : {}),
                ...(sort && {
                    'sort': sort.direction === 'desc' ? `-${sort.field}` : sort.field
                })
            };

            const response = await fetchData(params);
            setData(response);
            onSuccess?.(response);
        } catch (error) {
            onError?.(error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        loadData();
    }, [currentPage, sort, filters]);

    const handleSort = (columnId: string) => {
        setSort(current => {
            const newSort = current?.field !== columnId
                ? { field: columnId, direction: 'asc' as const }
                : current.direction === 'asc'
                    ? { field: columnId, direction: 'desc' as const }
                    : null;

            if (onSort) {
                onSort(columnId, newSort?.direction || null);
            }

            return newSort;
        });
    };

    const handlePageChange = (newPage: number) => {
        setCurrentPage(newPage);
    };

    return (
        <div className="space-y-4 bg-white min-w-full overflow-hidden">
            {/* Table Wrapper */}
            <div className="overflow-x-auto w-full">
                <Table className="min-w-full">
                    <Table.Header>
                        {columns.map(column => (
                            <Table.Column
                                key={column.id}
                                isRowHeader={column.isRowHeader}
                            >
                                <div className="flex items-center gap-2">
                                    {column.header}
                                    {column.sortable && (
                                        <Button
                                            appearance="plain"
                                            size="small"
                                            className="h-8 w-8 p-0"
                                            onPress={() => handleSort(column.id)}
                                        >
                                            <IconSortAsc className="size-5" />
                                        </Button>
                                    )}
                                </div>
                            </Table.Column>
                        ))}
                    </Table.Header>

                    <Table.Body
                        items={data.items || []}
                        renderEmptyState={() => (
                            <div className="flex flex-col items-center justify-center p-4">
                                {loading ? (
                                    <IconLoader2 className="h-6 w-6 animate-spin mx-auto" />
                                ) : (
                                    'No data found'
                                )}
                            </div>
                        )}
                    >
                        {(item) => (
                            <Table.Row key={item.id}>
                                {columns.map(column => (
                                    <Table.Cell key={column.id}>
                                        {column.cell(item)}
                                    </Table.Cell>
                                ))}
                            </Table.Row>
                        )}
                    </Table.Body>
                </Table>
            </div>

            {/* Pagination */}
            <div className="flex items-center justify-center gap-2">
                <Button
                    appearance="outline"
                    size="small"
                    onPress={() => handlePageChange(currentPage - 1)}
                    isDisabled={!data.prev_page || loading}
                >
                    <IconChevronLeft className="size-5" />
                </Button>
                <span className="text-sm">
                    Page {currentPage}
                </span>
                <Button
                    appearance="outline"
                    size="small"
                    onPress={() => handlePageChange(currentPage + 1)}
                    isDisabled={!data.next_page || loading}
                >
                    <IconChevronRight className="size-5" />
                </Button>
            </div>
        </div>
    );
};
